<?php

use damianbal\Models\Meeting;
use damianbal\Resources\AttendeeResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use damianbal\Resources\MeetingResource;
use damianbal\Models\Attendee;

/**
 * Return all meetings
 */
$app->get('/meetings', function (Request $request) use ($app) {
    $meetingRepository = $app->getEntityManager()->getRepository('damianbal\Models\Meeting');

    $meetings = $meetingRepository->findAll();

    $attendeeResource = new AttendeeResource;

    $jmeetings = [];

    foreach ($meetings as $meeting) {
        $jmeeting = $meeting->toJson();
        $jmeeting['attendees'] = $attendeeResource->collection($meeting->getAttendees());
        $jmeetings[] = $jmeeting;
    }

    return new JsonResponse($jmeetings);
});

/**
 * Add new meeting
 */
$app->post('/meetings', function (Request $request) use ($app) {

    $meeting = new Meeting();

    $meeting->setTitle($request->get('title'));
    $meeting->setLocation($request->get('location'));
    $meeting->setDescription($request->get('description'));

    $app->getEntityManager()->persist($meeting);
    $app->getEntityManager()->flush();

    return new JsonResponse(['created' => true, 'id' => $meeting->getId()], 201);
});

/**
 * Show meeting by id
 */
$app->get('/meetings/{id}', function (Request $request) use ($app) {

    $meeting = $app->getEntityManager()->find('damianbal\Models\Meeting', $request->get('id'));

    if ($meeting == null) {
        return new JsonResponse(['success' => false, 'message' => 'Meeting does not exist!']);
    }

    $meetingResource = new MeetingResource;

  // return new JsonResponse(array_merge($meeting->toJson(), ['success' => true]));
    return new JsonResponse(array_merge($meetingResource->one($meeting), ['success' => true]));
});

/**
 * Add new attendee to meeting
 */
$app->post('/meetings/{id}/attendees', function (Request $request) use ($app) {

    $name = $request->get('name');

    $meeting = $app->getEntityManager()->find('damianbal\Models\Meeting', $request->get('id'));

    $attendee = new Attendee;
    $attendee->setName($name);
    $attendee->setMeeting($meeting);

    $app->getEntityManager()->persist($attendee);
    $app->getEntityManager()->flush();

    return new JsonResponse(['created' => true, 'attendee_id' => $attendee->getId()]);
});

/**
 * Remove attendee from meeting, token required
 */
$app->delete('/attendees/{id}', function (Request $request) {

});

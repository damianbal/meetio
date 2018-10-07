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

    // check if meeting takes place before today
    if(new DateTime($request->get('date')) < new DateTime("now") || $request->get('date') === null )
    {
        return new JsonResponse(['created' => false, 'message' => 'Meeting must take place in future!']);
    }

    
    if($request->get('date'))
    {
        $meeting->setDate(new DateTime($request->get('date')));
    }
    else 
    {
        $meeting->setDate(new DateTime("now"));
    }

    $meeting->setDate(new DateTime($request->get('date')));

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

    if (!$request->get('name') || strlen($request->get('name')) < 3) {
        return new JsonResponse(['created' => false, 'message' => 'Missing name attribute or not valid!']);
    }

    $name = $request->get('name') ?? 'Unknown';

    $meeting = $app->getEntityManager()->find('damianbal\Models\Meeting', $request->get('id'));

    if ($meeting == null) {
        return new JsonResponse(['success' => false, 'message' => 'Meeting does not exist!']);
    }

    $attendee = new Attendee;
    $attendee->setName($name);
    $attendee->setMeeting($meeting);

    $app->getEntityManager()->persist($attendee);
    $app->getEntityManager()->flush();

    return new JsonResponse(['created' => true, 'attendee_id' => $attendee->getId()], 201);
});


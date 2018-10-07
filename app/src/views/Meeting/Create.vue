<template>
    <div class="card">
        <div class="card-header"><i class="fas fa-calendar"></i> Create Meeting</div>

        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-sm-8">
              <div class="form-group">
                    <label>Title</label> 
                    <input minlength="3" placeholder="Title of event" type="text" class="form-control">
                </div>
                    </div>
                    <div class="col-sm-4">
           <label>Location</label> 
                    <input minlength="3" placeholder="Location of event" type="text" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea placeholder="Description of event" class="form-control"></textarea>
                        </div>
                    </div>

                </div>
                
                <div class="text-right m-3">
                    <button type="submit" class="btn btn-dark"><i class="fas fa-plus"></i> Create Meeting</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>

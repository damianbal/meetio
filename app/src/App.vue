<template>
  <div id="app">
    <div class="container">
      <div class="row mb-4">
        <div class="col-sm-12">
          <nav class="navi bg-primary"> 
            <span class="brand">Meetio</span>
            <router-link :to="{ name: 'home'}">Home</router-link>
                        <router-link :to="{ name: 'meetingCreate'}">Create Meeting</router-link>

          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <router-view/>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
</style>

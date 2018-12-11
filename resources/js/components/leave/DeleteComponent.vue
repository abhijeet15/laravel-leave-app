<template>
<div v-show="page.show == 'delete'" id="idx-page-delete"  class="col-md-8">
  <div class="card">
      <div class="card-header">Delete Leave</div>

        <div class="card-body">
            <div class="alert alert-danger" role="alert"><p>Are you sure you want to delete Leave {{model.name}}#{{model.id}}?</p></div>

            <p>
                  <button @click.prevent="do_delete" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Delete</button>
                  <button @click.prevent="cancel_delete" type="button" class="btn btn-primary">Cancel</button>

            </p>
        </div>
  </div>
</div>
</template>

<script>

import { mapState, mapActions } from 'vuex';

    export default {
        data(){
            return{
            }
        },
        mounted( ){
        },
        computed:{
          
          ...mapState( [ 'page_heading', 'page', 'base_url', 'page_data' ] ),

          model( ){
            return this.page_data.model;
          }
        },
        methods : {
            ...mapActions( [ 'setShow', 'setModal', 'deleteLeave', 'showError', 'showSuccess' ] ),

            cancel_delete( ){
                this.setShow( 'listing' );
            },

            do_delete( event ){
              this.deleteLeave( this.model.id )
                .then(response => {
                      if( response.status == 200 )
                      {
                        this.setShow( 'listing' );
                        this.showSuccess( response.data.message );
                      }
                  }, error => {
                    this.showError( error.response.data.errors );
                  });
            }

        }
    }
</script>

<style>

</style>

<template>
    <div v-show="page.show == 'changerole'" id="idx-page-changerole"  class="col-md-8">
            <div class="card">
                <div class="card-header">Change User Role</div>

                <div class="card-body">

                  <p>Change role for User: {{model.name}}#{{model.id}}?</p>

                  <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Change Role To</label>

                        <div class="col-md-6">
                            <select class="form-control" v-model="model.role">
                              <option value="0">-- Select --</option>
                              <option v-for="(item, index) in role_types">{{role_types[index]}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @click.prevent="do_changerole" type="button" class="btn btn-danger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Change Role</button>

                                <button @click.prevent="cancel_changerole" type="button" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>

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
        components: {
        },
        mounted( ){
        },
        computed:{
          
          ...mapState( [ 'page_heading', 'page', 'base_url', 'page_data' ] ),

          model( ){
            return this.page_data.model;
          },
          role_types()
          {
            return js_parent_var.role_types
          }
        },
        methods : {
            ...mapActions( [ 'setShow', 'setModal', 'changeUserRole', 'showError', 'showSuccess' ] ),

            cancel_changerole( ){
                this.setShow( 'listing' );
            },

            do_changerole( event ){
              this.changeUserRole( )
                .then(response => {
                    if( response.status == 200 )
                    {
                      this.setShow( 'listing' );
                      this.showSuccess( response.data.message )
                    }
                }, error => {
                  this.showError( error.response.data.errors )
                });
            }
        }
    }
</script>

<style>

</style>

<template>
  <div v-show="page.show == 'edit'" id="idx-page-edit"  class="col-md-8">
            <div class="card">
                <div class="card-header">Add User</div>

                <div class="card-body">
                    <form @submit.prevent="add_edit">


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" :class="{'form-control':true, 'is-invalid':errors.name}" name="name" v-model="model.name" required autofocus>
                                    <span v-show="errors.name" class="invalid-feedback" role="alert">
                                        <strong>{{errors.name}}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" :class="{'form-control':true, 'is-invalid':errors.email}" name="email" v-model="model.email" required autofocus>
                                    <span v-show="errors.email" class="invalid-feedback" role="alert">
                                        <strong>{{errors.email}}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" :class="{'form-control':true, 'is-invalid':errors.password}" name="password" v-model="model.password" required autofocus>
                                    <span v-show="errors.password" class="invalid-feedback" role="alert">
                                        <strong>{{errors.password}}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" :class="{'form-control':true, 'is-invalid':errors.password_confirmation}" name="password_confirmation" v-model="model.password_confirmation" required autofocus>
                                    <span v-show="errors.password_confirmation" class="invalid-feedback" role="alert">
                                        <strong>{{errors.password_confirmation}}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>

                            <div class="col-md-6">
                                <select :class="{'form-control':true, 'is-invalid':errors.role}" v-model="model.role" required autofocus>
                                  <option value="">-- Select --</option>
                                  <option v-for="(item, index) in role_types">{{role_types[index]}}</option>
                                </select>
                                    <span v-show="errors.role" class="invalid-feedback" role="alert">
                                        <strong>{{errors.role}}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add User
                                </button>

                                <button type="button" @click="cancel_add" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</template>

<script>

import { mapState, mapActions } from 'vuex';
import Datepicker from 'vuejs-datepicker';


    export default {
        data(){
            return{
              format: "yyyy-MM-dd"
            }
        },
        components: {
          Datepicker
        },
        computed:{
            ...mapState( [ 'page', 'page_data' ] ),

            model( ){
                return this.page_data.model;
            },
            errors( ){
                return this.page_data.error_msg
            },
            role_types()
            {
                return js_parent_var.role_types
            }
        },
        methods : {
            ...mapActions( [ 'setShow', 'addUser', 'showError', 'showSuccess' ] ),

            cancel_add( ){
                this.setShow( 'listing' );
            },

            add_edit( event ){
              console.log( this.model );
              this.addUser( this.model )
              .then(response => {

                    

                    if( response.status == 200 )
                    {
                      this.setShow( 'listing' );
                      this.showSuccess( response.data.message );
                      // console.log("error ===" + JSON.stringify(response));
                    }
                    // console.log("Got some data, now lets show something in this component")
                }, error => {
                  this.showError( error.response.data.errors )
                  //console.log("error ===" + JSON.stringify(error.response));
                  //this.errors = error.response.data.errors;
                  //console.error("Got nothing from server. Prompt user to check internet connection and try again")
                });


                /*dispatch("updateUser", ).then(response => {
                    console.log("Got some data, now lets show something in this component")
                }, error => {
                    console.error("Got nothing from server. Prompt user to check internet connection and try again")
                })*/
              // event.preventDefault( );
            }
        }
    }
</script>

<style scoped>
.input-group{
  display:block !;
}
</style>

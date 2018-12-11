<template>
  <div v-show="page.show == 'add'" id="idx-page-add"  class="col-md-8">
            <div class="card">
                <div v-if='page_data.success_msg' class="alert alert-success">
                {{page_data.success_msg}}
              </div>
                <div class="card-header">Add Leave</div>

                <div class="card-body">
                    <form @submit.prevent="add_edit">


                        <div class="form-group row">
                            <label for="from_date" class="col-md-4 col-form-label text-md-right">From Date</label>

                            <div class="col-md-6">
                                <span :class="{'form-control':true, 'is-invalid':errors.from_date}" style="padding:0px !important; border: 0px solid black;">
                                <datepicker
                                    name="from_date"
                                    placeholder="Enter From Date"
                                    :bootstrapStyling="true"
                                    :calendarButton="true"
                                    :clearButton="true"
                                    :format="format"
                                    v-model="model.from_date"
                                  ></datepicker>
                                </span>
                                <span v-show="errors.from_date" class="invalid-feedback" role="alert">
                                    <strong>{{errors.from_date}}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="to_date" class="col-md-4 col-form-label text-md-right">To Date</label>

                            <div class="col-md-6">
                                <span :class="{'form-control':true, 'is-invalid':errors.to_date}" style="padding:0px !important; border: 0px solid black;"><datepicker
                                    name="to_date"
                                    placeholder="Enter From Date"
                                    :bootstrapStyling="true"
                                    :calendarButton="true"
                                    :clearButton="true"
                                    :format="format"
                                    v-model="model.to_date"
                                  ></datepicker></span>
                                
                                    <span v-show="errors.to_date" class="invalid-feedback" role="alert">
                                        <strong>{{errors.to_date}}</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reason" class="col-md-4 col-form-label text-md-right">Reason</label>

                            <div class="col-md-6">
                                <textarea :class="{'form-control':true, 'is-invalid':errors.reason}" v-model="model.reason"></textarea>
                                    <span v-show="errors.reason" class="invalid-feedback" role="alert">
                                        <strong>{{errors.reason}}</strong>
                                    </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="backup_user_id" class="col-md-4 col-form-label text-md-right">Backup Employee</label>

                            <div class="col-md-6">
                                <select :class="{'form-control':true, 'is-invalid':errors.backup_user_id}" v-model="model.backup_user_id">
                                  <option value="0">-- Select --</option>
                                  <option v-for="user in backup_users" :value="user.id">{{user.name}}</option>
                                </select>
                                <span v-show="errors.backup_user_id" class="invalid-feedback" role="alert">
                                    <strong>{{errors.backup_user_id}}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Leave
                                </button>
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
             backup_users(){
                return js_parent_var.backup_users;
             }
        },
        methods : {
            ...mapActions( [ 'setShow', 'addLeave', 'getLeave', 'showError', 'showSuccess' ] ),

            add_edit( event ){
                if( this.model.from_date )
                    this.model.from_date = window._commonFn._format_date( this.model.from_date );
                if( this.model.to_date )
                    this.model.to_date = window._commonFn._format_date( this.model.to_date );

              this.addLeave( this.model )
                .then(response => {
                    if( response.status == 200 )
                    {
                        this.getLeave( );
                        this.showSuccess( response.data.message );
                    }
                }, error => {

                  this.showError( error.response.data.errors )
                });
            }
        }
    }
</script>

<style scoped>
.input-group{
  display:block !;
}
</style>

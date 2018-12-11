<template>

<div v-show="page.show == 'listing'" id="idx-page-listing"  class="col-md-12">
      <button type="button" class="btn btn-link pull-left" @click="do_add( '' )">+ Add New User</button>
  <div class="card">
      <div class="card-header">Manage Users</div>
      <div v-if='page_data.success_msg' class="alert alert-success">
        {{page_data.success_msg}}
      </div>
      <div v-if='page_data.length' class="alert alert-danger">
        {{page_data.error_msg}}
      </div>

      <div class="card-body">
        <form @submit.prevent="do_search">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th style="width: 1%;" scope="col">#</th>
                    <th style="width: 20%;" scope="col">Name</th>
                    <th style="width: 20%;" scope="col">Email</th>
                    <th style="width: 20%;" scope="col">Role</th>
                    <th style="width: 20%;" scope="col">Created At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-if="has_records">
                      <tr v-for="record in collection">
                        <td scope="row">{{ record[ 'id' ] }}</td>
                        <td>{{ record.name }}</td>
                        <td>{{ record[ 'email' ] }}</td>
                        <td>{{ record[ 'role_label' ] }}</td>
                        <td>{{ record.created_at }}</td>
                        <td>
                          <div class="dropdown">
                              <button v-show="record[ 'role' ] != 'super_admin'" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
                                  <span class="glyphicon glyphicon-chevron-down"></span>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item"  @click="do_delete( record[ 'id' ] )" href="javascript: void( 0 );">Delete</a>
                                  <a class="dropdown-item"   @click="do_changerole( record[ 'id' ] )" href="javascript: void( 0 );">Change Role</a>
                              </div>
                          </div>

                        </td>
                      </tr>

                      <tr >
                        <td colspan="100%"><pagination></pagination></td>
                      </tr>
                  </template>
                  <template v-else>
                      <tr >
                        <td colspan="100%">No Records Found...</td>
                      </tr>
                  </template>
                      
                </tbody>
              </table>
            </form>
      </div>
  </div>
</div>
</template>

<script>
import pagination from './../common/PaginationComponent.vue';
import { mapState, mapActions } from 'vuex';
import Datepicker from 'vuejs-datepicker';

    export default {
        data(){
            return{
              format: "yyyy-MM-dd"
            }
        },
        mounted( ){
          this.listing( );
        },
        components: {
            'pagination': pagination,
            Datepicker
        },
        computed:{
             ...mapState( [ 'page_heading', 'page', 'base_url', 'page_data', 'all_categories' ] ),

            has_records( ){
              return this.collection.length > 0
            },
            collection( ){
              return this.page_data.collection;
            }
        },
        methods : {
            ...mapActions( [ 'setShow', 'setModal', 'getUsers', 'getUser', 'getCollectionUser', 'setMessageForAdd' ] ),

            listing( ) {
              this.getUsers( );
            },

            do_changerole( id ){

              this.getCollectionUser( id );
              this.setShow( 'changerole' );

            },
            
            do_delete( id ){

              this.getCollectionUser( id );
              this.setShow( 'delete' );

            },
            
            do_add( ){

              this.getUser( );
              this.setShow( 'edit' );
            },

            paginate( page )
            {
              this.getUsers( page );
            }
        }
    }
</script>

<style>

</style>
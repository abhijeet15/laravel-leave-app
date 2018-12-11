
export default {

  state: {
    collection: [ ],
    model: {},
    pagination:[ ],
    error_msg: [],
    success_msg: null

  },

  getters: {

  },

  actions: {

    updateLeaveCollection( { context, state },params ){


      let x = _.findKey( this.state.page_data.collection, function(  o ) { return ( o.id == params.id ) })

      // -- insert new data
      if( typeof x == "undefined" || parseInt( x ) < 0 )
        x = this.state.page_data.collection.length
      
      Vue.set( this.state.page_data.collection, x, params.data );
      
    },

    getLeaves( context, params )
    {
      let url = "" ;
      {
        for (var key in params) {
            if (url != "") {
                url += "&";
            }
            url += key + "=" + encodeURIComponent(params[key]);
        }
      }

      axios
        .get( js_parent_var.base_url + "/leave/list?" + url )
            .then(
                (response)  =>  {
                  
                  //if( response.status == 200 )
                    context.commit( 'UPDATE_LEAVE', response.data );


                    let pagination_param = {};
                    pagination_param.current_page = response.data.current_page;
                    pagination_param.first_page_url = response.data.first_page_url;
                    pagination_param.from = response.data.from;
                    pagination_param.to = response.data.to;
                    pagination_param.last_page_url = response.data.last_page_url;
                    pagination_param.last_page = response.data.last_page;
                    pagination_param.next_page_url = response.data.next_page_url;
                    pagination_param.path = response.data.path;
                    pagination_param.per_page = response.data.per_page;
                    pagination_param.prev_page_url = response.data.prev_page_url;
                    pagination_param.total = response.data.total;


                    context.commit( 'UPDATE_PAGINATION', pagination_param );
                    
                }, 
                (error)  =>  {
                    context.commit( 'UPDATE_LEAVE', { } );
                    context.commit( 'UPDATE_PAGINATION', 0 );
                }
            );
    },

    getLeave( context, id )
    {
        context.commit( 'UPDATE_LEAVE_MODEL', { } );

    },

    addLeave( { context, dispatch }, params )
    {
        return new Promise( function( resolve, reject ){
          axios
          .post( js_parent_var.base_url + "/leave", params )
              .then(
                  (response)  =>  {
                     resolve( response );
                     // dispatch( 'updateLeaveCollection', { id: params.id, data: response.data.data } )
                  }, 
                  (error)  =>  {
                      reject( error );
                  }
              );
        } );
        
    },

    deleteLeaveCollection( { context, state }, id ){


      let x = _.findKey( this.state.page_data.collection, function(  o ) { return ( o.id == id ) })

      Vue.delete( this.state.page_data.collection, x );
      
    },

    getCollectionLeave( { commit, state }, id ){
        let x = _.filter( this.state.page_data.collection, function(o) { return ( o.id == id ); });
        if( x.length > 0 )
          commit( 'UPDATE_LEAVE_MODEL', x[ 0 ] );
        else
        {
          commit( 'UPDATE_LEAVE_MODEL', { } );
        }

    },

    deleteLeave( { context, dispatch }, id )
    {
        return new Promise( function( resolve, reject ){
          axios
          .delete( js_parent_var.base_url + "/leave/" + id, { } )
              .then(
                  (response)  =>  {
                     resolve( response );
                     dispatch( 'deleteLeaveCollection', id );
                  }, 
                  (error)  =>  {
                      reject( error );
                  }
              );
        } );
        
    },

    showError( context, msg )
    {
        context.commit( 'UPDATE_ERROR_MSG', msg );
        context.commit( 'UPDATE_SUCCESS_MSG', null );

        setTimeout( function() { context.commit( 'UPDATE_ERROR_MSG', { } ) }, 6000 );
    },

    showSuccess( context, msg )
    {
        context.commit( 'UPDATE_SUCCESS_MSG', msg );
        context.commit( 'UPDATE_ERROR_MSG', {} );

        setTimeout( function() { context.commit( 'UPDATE_SUCCESS_MSG', null ) }, 6000 );
    }


  },

  mutations: {

    UPDATE_LEAVE(state, payload) {

      state.collection = payload.data;
    
    },

    UPDATE_PAGINATION(state, payload) {

      state.pagination = payload;
     
    },

    UPDATE_LEAVE_MODEL_ERRORS(state, payload) {

      state.pamodel_errorsgination = payload;
     
    },

    UPDATE_LEAVE_MODEL(state, payload) {
      state.model = payload;
     
    
    },

    UPDATE_ERROR_MSG(state, payload) {
      state.error_msg = payload;
     
    
    },

    UPDATE_SUCCESS_MSG(state, payload) {
      state.success_msg = payload;
     
    
    }
  }
}
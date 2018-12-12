/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
var app = {

    usuario:null,
    password:null,

    // Application Constructor

    initialize: function() {

        document.addEventListener('deviceready', this.onDeviceReady.bind(this), false);
                opcion(event, 'perfil');
    },

    // deviceready Event Handler
    //
    // Bind any cordova events here. Common events are:
    // 'pause', 'resume', etc.
    onDeviceReady: function() {

        this.receivedEvent('deviceready');

    },

    // Update DOM on a Received Event
    receivedEvent: function(id) {

        var parentElement = document.getElementById(id);
        //var listeningElement = parentElement.querySelector('.listening');
        //var receivedElement = parentElement.querySelector('.received');

        //listeningElement.setAttribute('style', 'display:none;');
        //receivedElement.setAttribute('style', 'display:block;');

        console.log('Received Event: ' + id);

    },


    alert:function(){

    var t = new Date();
    alert(t);

    },

     espera:function(){

    setTimeout(' window.location.href = "perfil.html"; ', 8000);

    },
    /*
    login:function(){

       $.ajax ({
               type:'Get',
               url:'http://localhost:52354/api/personal/?usuario='+$("#user_email").val()+'&pass='+$("#password").val(),
               data:{},
               contenType : 'application/json; charset=utf-8',
               dataType : 'json',

               success:function(data){
                       $.each(data,function(key,item){
            		            alert(' '+item.Nombre);
            	             });
               }
            }).fail(function(xhr,textStatus,err){
               alert(textStatus);
            });


    }
    */

};
             if ('addEventListener' in document) {
	document.addEventListener('DOMContentLoaded', function() {
		//app.inicio();
        app.initialize();
	}, false);
	document.addEventListener('deviceready', function() {
		app.onDeviceReady();
		//app.leerDatos();

	}, false);
}
 //////////////////////////////////////content//////////////////////////////
    function opcion(evt, strOpcion) {
    // Declare all variables
    var i,
        tabcontent,
        tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for ( i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";

    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for ( i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

       //if( localStorage.getItem('Ordenar') == 0 )
        //{
    	//document.getElementById('ordenar_cate').style.display = "none";
   // }
     //Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(strOpcion).style.display = "block";
    //evt.currentTarget.className += " active";
}




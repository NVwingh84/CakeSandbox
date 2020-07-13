<!-- File: templates/Customers/index.php -->

<?php  ?>

<h1> Vue.js Templates </h1>

<div id="app">
    
    <h3>Variable</h3>
    <textarea>{{name}}</textarea>      
    
    <h3>VModel</h3>
    <textarea v-model="name"></textarea>  
    
    <textarea v-model="number"></textarea>      
    <textarea>{{numbercomp(number)}}</textarea>     
        
    <p>{{now}}</p>
    
    <p>{{now}}</p>
    
</div>


<script>
    
    var app = new Vue({
        
        el:'#app',
        data: {
         
            name: "just some text",
            number: 40
            
        },
        // function runs with data, data can be changed..
        // data.getHours() only calculated once.. 
        computed: {
            now: function(){
             
               var data = new Date();
               return data.getHours() + this.name;
               
            }
        },
        methods: {
            numbercomp(getal){
                
                return 2*getal;
                
            }
        }        
    })
    
</script>



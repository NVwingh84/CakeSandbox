<!-- File: templates/Customers/index.php -->

<?php  ?>

<h1> Reacttest </h1>


<div id="app">
    
    <div v-if="3<4"> {{message}} </div>

    <input v-model="cart">

    <button v-on:click="addItem()">+</button>
    
</div>


<p id="paragraph"> {{name}}  
    
    <input type="text" v-model="maximum">    
    {{maximum}}
    <img :src="image">

</p>


<!-- you need to have a root element, then another v-for element, then your looped part -->
<div id="arrays">
    
    <div v-for="customer in customers">
        
        <p>{{customer.city}}</p>        
        
    </div>

</div>


<script>
    
    // var data 
    var data = {
        "message": 'Hello Vue!',
        "count": 40,
        "direction": 'left', 
        "cart": 0
      }
      
    var cakedata = <?php echo json_encode($present_customers); ?>; 
    
    console.log(cakedata);
    
    // component 1
    var app = new Vue({
      el: '#app',
      data: data, 
      methods: {
        addItem: function(){
            this.cart = this.cart + 1;
        }
      }
    })    
    
    // component 2 : paragraph or div where everything happens inside.. 
    var parag = new Vue({
      el: '#paragraph',
      data: {
        name: cakedata[0]['name'],
        image: "https://bs-uploads.toptal.io/blackfish-uploads/blog/common_mistakes_guide/content/cover_image_file/cover_image/15954/cover-default-cover-3-fe3aac7995ddc0c1b7185c61fa1cc6a5.png",
        maximum: 40
      }
    })       
    
    // component 3 : checking cakephp array handling 
    var arrays = new Vue({
       el: '#arrays',
       data: {
         customers: cakedata
       }
    })
    
</script>



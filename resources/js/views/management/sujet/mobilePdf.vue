<template>
  <div>
      <CartGrise v-if="open" :pdf-data="pdfData" />
      <el-button @click="sujetData4pdf">click me</el-button>
      <h1>hello world</h1>
  </div>
</template>

<script>
import CartGrise from './PdfGenerator';
import Axios from 'axios';
export default {
  components:{
   CartGrise
  },
  data(){
    return {
     pdfData:{},
     open:false
    }
  },
  created(){
  console.log("this is my route" , this.$route.params.id )
  this.open=false;

  },
  methods:{

   sujetData4pdf() {

      Axios.get('/api/PdfData/' +   this.$route.params.id + '/GET')

        .then((response) => {
          this.pdfData = response.data.Pdf;
          this.open=true;

        })
        .catch((error) => {
          console.log(error);
        });

    },

  }

}
</script>

<style>

</style>

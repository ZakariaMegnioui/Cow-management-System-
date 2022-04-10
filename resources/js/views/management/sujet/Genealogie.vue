<template>
  <div class="row m-2">
    <!-- Start Col Mere -->
    <div
      v-for="(item, index) in genealogie"
      :key="index"
      class="col-xl-6 col-12 mb-5"
    >
      <!--Start Card -->
      <div class="card h-100">
        <div class="card-header text-gray-800 text-xl font-bold">
          {{ item.target }}
        </div>
        <div class="card-body">
          <SmallForm :items="item" :disaibeld="isDisaibeld" :genealogie="genealogie" @getgenelogie="handelgenelogie" />
        </div>
      </div>
      <!--End Card -->
    </div>
  </div>
  <!--End Row -->
</template>

<script>
import SmallForm from './SmallForm.vue';
export default {
  name: 'Genealogie',
  components: {
    SmallForm,
  },
  data() {
    return {
      test: 'test',
      genealogie: [
        // --------- Pére ----------
        {
          // pére
          target: 'Pere',
          information: {
            Numero: '',
            Nom: '',
            Datenaissance: new Date(),
            Race: '',
          },
        },
        {
          // mére
          target: 'Mere',
          information: {
            SNIT: '',
            'Datenaissance': new Date(),
            Race: '',
          },
        },
        {
          // grand mere peternell (GMP)
          target: 'Grand Mere Paternell',
          information: {
            Numero: '',
            'Datenaissance': new Date(),
            Race: '',
          },
        },
        {
          // grand pere maternell (GPM)
          target: 'Grand Pere Maternell',
          information: {
            Numero: '',
            Nom: '',
            'Datenaissance': new Date(),
            Race: '',
          },
        },
        {
          // grand pere peternell (GPP)
          target: 'Grand Pere Paternell',
          information: {
            Numero: '',
            Nom: '',
            'Datenaissance': new Date(),
            Race: '',
          },
        },
        // ----------- Mere ---------

        {
          // grand mere maternell (GMM)
          target: 'Grand Mere Maternell',
          information: {
            NSNIT: '',
            'Datenaissance': new Date(),
            Race: '',
          },
        },
      ],
      isDisaibeld: false,
    };
  },
  computed: {
    // a computed getter
    b: function() {
      // `this` points to the vm instance
      return this.genealogie;
    },
  },
  watch: {
    genealogie: function(value){
      this.$emit('getgenelogie', value);
    },
  },
  created() {
    this.$emit('getgenelogie', this.b);
  },
  emits: ['getgenelogie'],
  methods: {
    passvariables() {
      this.$emit('genealogie', this.genealogie);
    },
    handelgenelogie(name){
      console.log(name);
      this.genealogie = name;
    },
  },
};
</script>

<style lang="scss" scoped>
.card-body {
  justify-content: space-between;
  display: flex;
  flex-direction: column;
}
</style>

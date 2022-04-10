<template>
  <div class="dashboard-editor-container" style="padding: 0 3.2rem;">
    <!--<github-corner style="position: absolute; top: 0px; border: 0, right: 0," />-->

    <div class="grey-bg container-fluid">
      <top-card :count-elelement="CountElelement" />
    </div>
    <el-card class="box-card">
      <!-- <el-button @click="
      createSujet()">Insert query Sql</el-button> -->
      <div slot="header" class="clearfix">
        <span style="color: rgba(0, 0, 0, 0.45) ">
          <i class="el-icon-s-marketing" /> Dèclaration
        </span>
        <div style="float: right; padding: 3px 0" class="grid md:grid-cols-4 gap-3 xs:grid-cols-1">
          <el-select
            v-model="value_Y"
            class="select"
            size="small"
            placeholder="Year"
            @change="getSujets('year')"
          >
            <el-option v-for="item in options_Y" :key="item" :label="item" :value="item" />
          </el-select>
          <el-select
            v-model="value_R"
            class="select"
            size="small"
            filterable
            placeholder="Rigion"
            @change="getSujets('rigion')"
          >
            <el-option
              v-for="item in options_R"
              :key="item.Adresse"
              :label="item.Adresse"
              :value="item.Adresse"
            />
          </el-select>
          <el-select
            v-model="value_EN"
            class="select"
            size="small"
            filterable
            placeholder="Naisseur"
            @change="getSujets('naisseur')"
          >
            <el-option
              v-for="item in options_EN"
              :key="item.id"
              :label="item.Nom + ` ` +item.Prenom "
              :value="item.id"
            />
          </el-select>

          <el-select
            v-model="value_EP"
            class="select"
            size="small"
            filterable
            placeholder="Proprietaire"
            @change="getSujets('proprietaire')"
          >
            <el-option
              v-for="item in options_EP"
              :key="item.id"
              :label="item.Nom + ` ` +item.Prenom "
              :value="item.id"
            />
          </el-select>
        </div>
      </div>

      <el-row style="background: #fff; padding: 16px 16px 0, margin-bottom: 32px; ">
        <line-chart :chart-data="chartData" />
      </el-row>
    </el-card>
    <el-row>
      <div class="grey-bg container-fluid mt-8">
        <bottom-card :count-elelement="CountElelement" />
      </div>
    </el-row>

    <el-card class="box-card">
      <el-row style="background: #fff; padding: 16px 16px 0, margin-bottom: 32px; ">
        <line-chart :chart-data="chartData" />
      </el-row>
    </el-card>
  </div>
</template>

<script>
import LineChart from './components/LineChart';
import Axios from 'axios';
import TopCard from './components/TopCard.vue';
import BottomCard from './components/BottomCard.vue';
// import json from './components/data.json';

export default {
  name: 'DashboardAdmin',
  components: {
    // json,
    LineChart,
    TopCard,
    BottomCard,
  },
  data() {
    return {
      open: false,
      // myjson: json,
      years: [],
      options_Y: [],
      options_EN: [],
      options_EP: [],
      options_R: [],
      value_Y: new Date().getFullYear(),
      value_R: '',
      value_EN: '',
      value_EP: '',
      chartData: {
        veauData: [],
        sorteData: [],
        vacheData: [],
      },
      CountElelement: {
        countSujet: 0,
        countVeau: 0,
        countSortie: 0,
        countRigion: 0,
      },
      sujets: [],
      vacheCount: {},
      veauCount: {},
      sorteCount: {},
    };
  },
  computed: {
    getYears() {
      const year = new Date().getFullYear();
      return Array.from(
        { length: year - 2009 },
        (value, index) => 2010 + index
      );
    },
  },

  beforeMount() {},
  created() {

    this.getProduction();
    this.vacheCount = this.startValues();
    this.sorteCount = this.startValues();
    this.veauCount = this.startValues();
    const success = (position) => {
      this.latitude = position.coords.latitude.toString();
      this.longitude = position.coords.longitude.toString();

      // Do something with the position
    };

    // This will open permission popup
    navigator.geolocation.getCurrentPosition(success);
  },

  mounted() {
    this.getFilters();
    this.open = false;
    this.getSujets('year');
    this.options_Y = this.getYears;
  },

  methods: {
    // createSujet() {
    //   Axios.post('/api/Sujet/', {'data': this.myjson})
    //     .then((res) => {
    //       const msg = res.data.Msg;
    //       if (msg !== undefined) {
    //         this.errNotify(
    //           'Il y à une sujet avec ce Reference Dans la base de donnee.'
    //         );
    //       } else {
    //         this.$notify({
    //           title: 'Success',
    //           message: 'Sujet Bien Ajoutee',
    //           type: 'success',
    //           duration: 2000,
    //         });
    //         console.log(res.data.data)
    //       }
    //     })
    //     .catch((err) => {
    //       console.log(err);
    //     });
    // },
    getMonth(d) {
      const date = new Date(d);
      const name = date.toLocaleString('default', { month: 'long' });

      return name;
    },
    getFilters() {
      Axios.get('/api/SujetsCount')
        .then((response) => {
          this.options_EN = response.data.EVN;
          this.options_EP = response.data.EVP;
          this.options_R = response.data.RIJ;
          this.CountElelement.countRigion = this.options_R.length;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getYear(d) {
      const date = new Date(d);
      const name = date.getFullYear();

      return name;
    },
    countItem(item) {
      if (item.Type === 'Vache' && item.Etat === 'Active') {
        this.CountElelement.countSujet += 1;
      } else if (item.Type === 'Veau' && item.Etat === 'Active') {
        this.CountElelement.countVeau += 1;
      } else {
        this.CountElelement.countSortie += 1;
      }
    },
    getProduction() {
      Axios.get('/api/Productionlaitieresujets')
        .then((response) => {
          console.log(response.data.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getSujets(filter) {
      this.CountElelement.countSujet = 0;
      this.CountElelement.countVeau = 0;
      this.CountElelement.countSortie = 0;
      this.chartData.veauData = [];
      this.cleanUp(this.chartData.sorteData, this.sorteCount);
      this.cleanUp(this.chartData.veauData, this.veauCount);
      this.cleanUp(this.chartData.vacheData, this.vacheCount);
      Axios.get('http://127.0.0.1:8000/api/Sujet')
        .then((response) => {
          this.sujets = response.data.data;

          this.sujets.map((item) => {
            this.countItem(item);

            if (filter === 'year') {
              if (this.getYear(item.created_at) === this.value_Y) {
                this.vacheVal(
                  this.getMonth(item.created_at),
                  item.Type,
                  item.Etat
                );
              }
              this.value_R = '';
              this.value_EN = null;
              this.value_EP = null;
            } else if (filter === 'rigion') {
              if (item.Adresse === this.value_R) {
                this.vacheVal(
                  this.getMonth(item.created_at),
                  item.Type,
                  item.Etat
                );
              }
              this.value_Y = null;
              this.value_EN = null;
              this.value_EP = null;
            } else if (filter === 'naisseur') {
              if (item.EleveurNaisseurs_ID === this.value_EN) {
                this.vacheVal(
                  this.getMonth(item.created_at),
                  item.Type,
                  item.Etat
                );
              }
              this.value_Y = null;
              this.value_R = null;
              this.value_EP = null;
            } else if (filter === 'proprietaire') {
              if (item.EleveurProprietaires_ID === this.value_EP) {
                this.vacheVal(
                  this.getMonth(item.created_at),
                  item.Type,
                  item.Etat
                );
              }
              this.value_Y = null;
              this.value_R = null;
              this.value_EN = null;
            }
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },

    vacheVal(sujet, type, etat) {
      if (type === 'Vache' && etat === 'Active') {
        this.switch(sujet, this.vacheCount);
      } else if (type === 'Veau' && etat === 'Active') {
        this.switch(sujet, this.veauCount);
      } else if (etat !== 'Active') {
        this.switch(sujet, this.sorteCount);
      }

      this.chartData.vacheData = [];

      this.copeiArr(this.chartData.vacheData, this.vacheCount);
      this.copeiArr(this.chartData.veauData, this.veauCount);
      this.copeiArr(this.chartData.sorteData, this.sorteCount);
    },
    copeiArr(arr, obj) {
      let i = 0;
      for (const [key, value] of Object.entries(obj)) {
        arr[i] = value;
        i++;
        key ? '' : '';
      }
    },
    cleanUp(arr, obj) {
      for (const [key, value] of Object.entries(obj)) {
        obj[key] = 0;
        value ? '' : '';
      }
      this.copeiArr(arr, obj);
    },
    switch(sujet, count) {
      switch (sujet) {
        case 'January':
          count.jan += 1;
          break;
        case 'February':
          count.feb += 1;
          break;
        case 'March':
          count.mar += 1;
          break;
        case 'April':
          count.apr += 1;
          break;
        case 'May':
          count.may += 1;
          break;
        case 'June':
          count.jun += 1;
          break;
        case 'July':
          count.jul += 1;
          break;
        case 'August':
          count.aug += 1;
          break;
        case 'September':
          count.sep += 1;
          break;
        case 'October':
          count.oct += 1;
          break;
        case 'November ':
          count.nov += 1;
          break;
        default:
          count.dec += 1;
          break;
      }
    },
    startValues() {
      return {
        jan: 0,
        feb: 0,
        mar: 0,
        apr: 0,
        may: 0,
        jun: 0,
        jul: 0,
        aug: 0,
        sep: 0,
        oct: 0,
        nov: 0,
        dec: 0,
      };
    },
  },
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.dashboard-editor-container {
  padding: 32px;
  background-color: rgb(240, 242, 245);
  .chart-wrapper {
    background: rgb(189, 83, 13);
    padding: 16px 16px 0;
    margin-bottom: 32px;
  }
}
span {
  margin-left: 20px;
  font-weight: bold;
}
.text {
  font-size: 14px;
}

.item {
  margin-bottom: 18px;
}

.clearfix:before,
.clearfix:after {
  display: table;
  content: '';
}
.clearfix:after {
  clear: both;
}

.box-card2 {
  width: 620px;
}
.select {
  width: 120px;
}
</style>

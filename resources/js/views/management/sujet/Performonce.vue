<template>
  <div :class="status ==='show' ? 'disable' : ''">
    <!-- Sujet -->
    <div class="card mb-5 pb-2 ">
      <div class="card-header ">
        Sujet
      </div>
      <div class="card-body">
        <div
          v-for="(item,index) in data.ProductionItemsSujet"
          :key="index"
          class="row formRepeater md:flex md:justify-between  mb-2 mt-2 rounded-md "
        >
          <div class="col-9 p-1 row">
            <div class="mb-3 col">
              <label for="numero" class="fs-6 fw-normal mb-2"> N° </label>
              <input id="numero" disabled :value="rowsCount+1" type="text" class="form-control">
            </div>
            <div class="mb-3 col">
              <label for="ageVelage" class="fs-6 fw-normal mb-2">Age Velage</label>
              <input :disabled="status==='show'" id="ageVelage" v-model="item.AgeVelage" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="numero" class="fs-6 fw-normal mb-2">Kg Lait</label>
              <input :disabled="status==='show'" id="numero" v-model="item.KgLait" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="persent_mg" class="fs-6 fw-normal mb-2">% MG</label>
              <input :disabled="status==='show'" id="persent_mg" v-model="item.MG" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="kg_mg" class="fs-6 fw-normal mb-2">Kg MG</label>
              <input :disabled="status==='show'" id="kg_mg" v-model="item.KgMG" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="persent_prot" class="fs-6 fw-normal mb-2">% Port</label>
              <input :disabled="status==='show'" id="persent_prot" v-model="item.Prot" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="kg_prot" class="fs-6 fw-normal mb-2">Kg Port</label>
              <input :disabled="status==='show'" id="kg_prot" v-model="item.KgProt" type="text" class="form-control" />
            </div>
          </div>
          <div class="col-3 row">
            <div class="mt-2 col  align-items-center d-flex">
              <el-button
                type="success"
                icon="el-icon-check"
                @click="validerSujet(index)"
              >{{item.id ?'Modifier' : 'Valider'}}</el-button>
              <el-button
                type="danger"
                plain
                icon="el-icon-remove"
                @click="deletePerformonce(index,'ProductionItemsSujet')"
              >Delete</el-button>
            </div>
          </div>
        </div>
      </div>

      <el-button type="primary" class="addBtn" :disabled="rowsCount>7" icon="el-icon-circle-plus" @click="addPerformonce('ProductionItemsSujet')">Ajouter</el-button>

    </div>
    <!-- Mere -->
    <div class="card mb-5 pb-2">
      <div class="card-header ">
        Mere
      </div>
      <div class="card-body">
        <div
          v-for="(item,index) in data.ProductionItemsMere"
          :key="index"
          class="row formRepeater md:flex md:justify-between p-2 mb-2 mt-2"
        >
          <div class="col-9 row">
            <div class="mb-3 col">
              <label for="numero" class="fs-6 fw-normal mb-2">N°</label>
              <input :disabled="status==='show'" id="numero" v-model="item.NLACT" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="ageVelage" class="fs-6 fw-normal mb-2">Age Velage</label>
              <input :disabled="status==='show'" id="ageVelage" v-model="item.AgeVelage" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="numero" class="fs-6 fw-normal mb-2">Kg Lait</label>
              <input :disabled="status==='show'" id="numero" v-model="item.KgLait" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="persent_mg" class="fs-6 fw-normal mb-2">% MG</label>
              <input :disabled="status==='show'" id="persent_mg" v-model="item.MG" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="kg_mg" class="fs-6 fw-normal mb-2">Kg MG</label>
              <input :disabled="status==='show'" id="kg_mg" v-model="item.KgMG" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="persent_prot" class="fs-6 fw-normal mb-2">% Port</label>
              <input :disabled="status==='show'" id="persent_prot" v-model="item.Prot" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="kg_prot" class="fs-6 fw-normal mb-2">Kg Port</label>
              <input :disabled="status==='show'" id="kg_prot" v-model="item.KgProt" type="text" class="form-control" />
            </div>
          </div>
          <div class="col-3 row">
            <div class="mt-2 col align-items-center d-flex">
              <el-button
                type="success"
                icon="el-icon-check"
                @click="validerMere(index)"
              >{{item.id ?'Modifier' : 'Valider'}}</el-button>
              <el-button
                type="danger"
                plain
                icon="el-icon-remove"
                @click="deletePerformonce(index,'ProductionItemsMere')"
              >Delete</el-button>
            </div>
          </div>
        </div>
      </div>
      <el-button type="primary" class="addBtn" icon="el-icon-circle-plus" @click="addPerformonce('ProductionItemsMere')">Ajouter</el-button>
    </div>
    <!-- Grand Mere -->
    <div class="card mb-5 pb-2">
      <div class="card-header">
        Grand Mére Maternel
      </div>
      <div class="card-body">
        <div
          v-for="(item,index) in data.ProductionItemsGrandMere"
          :key="index"
          class="row formRepeater md:flex md:justify-between p-2 mb-2 mt-2"
        >
          <div class="col-9 p-1 row">
            <div class="mb-3 col">
              <label for="numero" class="fs-6 fw-normal mb-2">N°</label>
              <input :disabled="status==='show'" id="numero" v-model="item.N_LACT" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="ageVelage" class="fs-6 fw-normal mb-2">Age Velage</label>
              <input :disabled="status==='show'" id="ageVelage" v-model="item.Age_V_lage" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="numero" class="fs-6 fw-normal mb-2">Kg Lait</label>
              <input :disabled="status==='show'" id="numero" v-model="item.Kg_Lait" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="persent_mg" class="fs-6 fw-normal mb-2">% MG</label>
              <input :disabled="status==='show'" id="persent_mg" v-model="item.MG" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="kg_mg" class="fs-6 fw-normal mb-2">Kg MG</label>
              <input :disabled="status==='show'" id="kg_mg" v-model="item.KgMG" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="persent_prot" class="fs-6 fw-normal mb-2">% Port</label>
              <input :disabled="status==='show'" id="persent_prot" v-model="item.Prot" type="text" class="form-control" />
            </div>
            <div class="mb-3 col">
              <label for="kg_prot" class="fs-6 fw-normal mb-2">Kg Port</label>
              <input :disabled="status==='show'" id="kg_prot" v-model="item.KgProt" type="text" class="form-control" />
            </div>
          </div>
          <div class="col-3 row">
            <div class="mt-2 col align-items-center d-flex">
              <el-button
                type="success"
                icon="el-icon-check"
                @click="validerGrandMereMaternel(index)"
              >{{item.id ?'Modifier' : 'Valider'}}</el-button>
              <el-button
                type="danger"
                plain
                icon="el-icon-remove"
                @click="deletePerformonce(index,'ProductionItemsGrandMere')"
              >Delete</el-button>
            </div>
          </div>
        </div>
      </div>

      <el-button type="primary" class="addBtn" icon="el-icon-circle-plus" @click="addPerformonce('ProductionItemsGrandMere')">Ajouter</el-button>
    </div>
  </div>
</template>

<script>
import Axios from 'axios';
export default {
  name: 'Performonce',
  props: {
    // eslint-disable-next-line vue/require-prop-types
    sujet: {
      Type: Object,
      default: () => {},
    },
    pdf: {
      Type: Object,
      default: () => {},
    },
    status: {
      Type: String,
    },
  },
  data() {
    return {
      rowsCount: 0,
      data: {
        pdf: {},

        ProductionItemsSujet: [
          {
            id: null,
            NLACT: '',
            AgeVelage: '',
            KgLait: '',
            MG: '',
            KgMG: '',
            Prot: '',
            KgProt: '',
            sujet_id: '',
          },
        ],
        ProductionItemsMere: [
          {
            id: null,
            NLACT: '',
            AgeVelage: '',
            KgLait: '',
            MG: '',
            KgMG: '',
            Prot: '',
            KgProt: '',
            meres_ID: '',
          },
        ],
        ProductionItemsGrandMere: [
          {
            id: null,
            N_LACT: '',
            Age_V_lage: '',
            Kg_Lait: '',
            MG: '',
            KgMG: '',
            Prot: '',
            KgProt: '',
            GMMaternelle_Id: '',
          },
        ],
      },
      nextItemSujet: 2,
      nextItemMere: 2,
      nextItemGrandMere: 2,
    };
  },
  created() {},
  watch: {
    pdf() {
      if (this.status !== 'add') this.setVal(this.pdf);
    },
    deep: true,
  },
  methods: {
    addPerformonce(target){
      this.rowsCount = this.rowsCount + 1;
      if (target === 'ProductionItemsSujet'){
        this.data.ProductionItemsSujet.push({
          id: null,
        });
      } else if (target === 'ProductionItemsMere') {
        this.data.ProductionItemsMere.push({
          id: null,
        });
      } else {
        this.data.ProductionItemsGrandMere.push({
          id: null,
        });
      }
    },
    deletePerformonce(index, target, run) {
      if (target === 'ProductionItemsSujet') {
        // this.$emit('getperformoncesujetdata', this.data);

        this.deleteRecord(
          this.data.ProductionItemsSujet[index].id,
          '/api/Productionlaitieresujets/',
          run
        );
        this.data.ProductionItemsSujet.splice(index, 1);
      }
      if (target === 'ProductionItemsMere') {
        // this.$emit('getperformonceMeredata', this.data);
        this.deleteRecord(
          this.data.ProductionItemsMere[index].id,
          '/api/Productionlaitieremeres/',
          run
        );
        this.data.ProductionItemsMere.splice(index, 1);
      }
      if (target === 'ProductionItemsGrandMere') {
        // this.$emit('getperformonceGMerMaterneldata', this.data);
        this.deleteRecord(
          this.data.ProductionItemsGrandMere[index].id,
          'api/Plaitieregrandmerematernelles/',
          run
        );
        this.data.ProductionItemsGrandMere.splice(index, 1);
      }
    },
    // Valider funtions
    validerSujet(index) {
      if (
        this.sujet.id !== '' &&
        this.data.ProductionItemsSujet[index].id === null
      ) {
        this.data.ProductionItemsSujet[index].sujet_id = this.sujet.id;

        Axios.post(
          'api/Productionlaitieresujets/',
          this.data.ProductionItemsSujet[index]
        )

          .then((res) => {
            this.$notify({
              title: 'Success',
              message: 'Production Sujet Bien Ajoutee',
              type: 'success',
              duration: 2000,
            });
            if (this.status === 'update') {
              this.data.ProductionItemsSujet.push(res.data.data);
            }

            this.deletePerformonce(index, 'ProductionItemsSujet');
          })
          .catch((err) => {
            this.$notify({
              title: 'Error',
              message: err,
              type: 'error',
              duration: 2000,
            });
          });
      } else if (
        this.sujet.id !== '' &&
        this.data.ProductionItemsSujet[index].id !== null
      ) {
        this.updateRecord(
          'api/Productionlaitieresujets/',
          this.data.ProductionItemsSujet,
          index,
          'ProductionItemsSujet'
        );
      } else {
        this.infoNotify('Le champ Sujet Reference doit être rempli. Ou, un sujet existant doit être spécifié.');
      }
    },
    validerMere(index) {
      if (
        this.sujet.mere.id !== null &&
        this.data.ProductionItemsMere[index].id === null
      ) {
        this.data.ProductionItemsMere[index].meres_ID = this.sujet.mere.id;

        Axios.post(
          'api/Productionlaitieremeres/',
          this.data.ProductionItemsMere[index]
        )

          .then((res) => {
            this.$notify({
              title: 'Success',
              message: 'Production Sujet Bien Ajoutee',
              type: 'success',
              duration: 2000,
            });
            if (this.status === 'update') {
              this.data.ProductionItemsMere.push(res.data.data);
            }
            this.deletePerformonce(index, 'ProductionItemsMere');
          })
          .catch((err) => {
            this.$notify({
              title: 'Error',
              message: err,
              type: 'error',
              duration: 2000,
            });
          });
      } else if (
        this.sujet.mere.id !== null &&
        this.data.ProductionItemsMere[index].id !== null
      ) {
        this.updateRecord(
          'api/Productionlaitieremeres/',
          this.data.ProductionItemsMere,
          index,
          'ProductionItemsMere'
        );
      } else {
        this.infoNotify('Le champ Mere doit être rempli. Ou, une mere existant doit être spécifié.');
      }
    },
    validerGrandMereMaternel(index) {

      if (
        this.sujet.grandMereMaternell.id !== null &&
        this.data.ProductionItemsGrandMere[index].id === null
      ) {
        this.data.ProductionItemsGrandMere[index].GMMaternelle_Id =
          this.sujet.grandMereMaternell.id;
        Axios.post(
          'api/Plaitieregrandmerematernelles/',
          this.data.ProductionItemsGrandMere[index]
        )

          .then((res) => {
            this.$notify({
              title: 'Success',
              message: 'Production Sujet Bien Ajoutee',
              type: 'success',
              duration: 2000,
            });
            if (this.status === 'update') {
              this.data.ProductionItemsGrandMere.push(res.data.data);
            }

            this.deletePerformonce(index, 'ProductionItemsGrandMere');
          })
          .catch((err) => {
            this.$notify({
              title: 'Error',
              message: err,
              type: 'error',
              duration: 2000,
            });
          });
      } else if (
        this.sujet.grandMereMaternell.id !== null &&
        this.data.ProductionItemsGrandMere[index].id !== null
      ) {
        this.updateRecord(
          'api/Plaitieregrandmerematernelles/',
          this.data.ProductionItemsGrandMere,
          index,
          'ProductionItemsGrandMere'
        );
      } else {
        this.infoNotify('Le champ Grand Mere Maternel Reference doit être rempli. Ou, un Grand Mere Maternel existant doit être spécifié.');
      }
    },
    infoNotify(msg) {
      this.$notify({
        title: 'info',
        message: msg,
        type: 'info',
        duration: 2000,
      });
    },
    setVal(obj) {
      if (obj.PLS.length > 0) {
        this.data.ProductionItemsSujet = obj.PLS;
      }
      if (obj.PLM.length > 0) {
        this.data.ProductionItemsMere = obj.PLM;
      }
      if (obj.PLMM.length > 0) {
        this.data.ProductionItemsGrandMere = obj.PLMM;
      }
    },
    deleteRecord(id, URL, run) {
      if (this.status === 'update' && id !== null && run !== 'stop') {
        Axios.delete(URL + id)
          .then((res) => {
            this.$notify({
              title: 'Success',
              message: res.data.msg,
              type: 'success',
              duration: 2000,
            });
          })
          .catch((err) => {
            this.$notify({
              title: 'Error',
              message: err,
              type: 'info',
              duration: 2000,
            });
          });
      }
    },
    updateRecord(URL, OBJ, INDEX, TARGET) {
      Axios.put(URL + OBJ[INDEX].id, OBJ[INDEX])

        .then((res) => {
          this.$notify({
            title: 'Success',
            message: 'Production Sujet Bien Modifié',
            type: 'success',
            duration: 2000,
          });
          if (this.status === 'update') {
            OBJ.push(res.data.data);
          }

          this.deletePerformonce(INDEX, TARGET, 'stop');
        })
        .catch((err) => {
          this.$notify({
            title: 'Error',
            message: err,
            type: 'error',
            duration: 2000,
          });
        });
    },
  },
};
</script>


<style scoped>
.disable {
  pointer-events: none;
  }
.card{
  box-shadow:0 4px 24px 0 rgb(34 41 47 / 10%) !important;
  border-radius: .5rem;
  overflow: hidden;
  /* border: 1px solid rgba(0, 0, 0, 0.027) !important; */
}
.card .card-header{
  font-family: inherit;
  font-weight: 500 !important;
  line-height: 1.2 !important;
  color: #7367f0 !important;
  font-size: 1.3rem !important;
  background-color:#ffff !important;
}
.card .card-body label{
  color: #5e5873 !important;
  font-size: .857rem !important;
}
.card .card-body .form-control:focus {
   background-color: #fff !important;
    border-color: #7367f0 !important;
    box-shadow: 0 3px 10px 0 rgb(34 41 47 / 10%) !important;
}
.card .card-body .el-button.el-button--success{
  background-color:#28c76f !important;
  width:100%;
}
.card .card-body .el-button.el-button--success:hover,
.card .card-body .el-button.el-button--success:focus{
  background-color:#1f9d57 !important;
}
.card .card-body .el-button.el-button--danger{
  background-color:#f08182 !important;
  color:white !important;
  width:100%;
}
.card .card-body .el-button.el-button--danger:hover,
.card .card-body .el-button.el-button--danger:focus{
  background-color: #e42728 !important;
}
.card .card-body .el-button.el-button--warning{
  background-color:#ff9f43 !important;
  width:100%;
}
.addBtn{
  width: 10rem;
  margin: 0 0.3rem;
  background-color: #7367f0 !important;
}
.addBtn:hover,
.addBtn:focus{
  background-color: #4839eb !important;
  border-color:#4839eb !important;
}
.card .card-body .formRepeater{
  background-color:#9ca0a413 !important;
  box-shadow:0 4px 24px 0 rgb(34 41 47 / 10%) !important;
  border: 1px solid rgba(0,0,0,.125) !important;
  border-radius: .5rem;
}
</style>

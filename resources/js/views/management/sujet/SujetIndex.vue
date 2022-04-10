<template>
  <div :class="status ==='show' ? 'disable' : ''">
    <div class="card mt-5 mb-5 pb-2">
      <div class="card-header ">
        Index laitiers du Pére
      </div>
      <div class="card-body">
        <div
          class="row md:flex md:justify-between"
        >
          <div class="col-9 row">
            <div
              v-for="(value,proprty,index) in data.indexLaitiersPere"
              :key="index"
              class="mb-3 col"
            >
              <label v-if="proprty !== 'pere_id' &&proprty !== 'id'" for="numero" class="fs-6 fw-normal mb-2">{{ proprty }}</label>
              <input
                v-if="proprty !== 'pere_id' &&proprty !== 'id'"
                id="numero"
                :disabled="status==='show'"
                v-model="data.indexLaitiersPere[proprty]"
                type="text"
                class="form-control"
              />
            </div>
          </div>
          <div class="col-3 row">
            <div class="mt-2 col -ml-2 align-items-center d-flex">
              <el-button
                type="success"
                icon="el-icon-check"
                @click="validIndex('api/Indexeslaitiersperes/' , data.indexLaitiersPere)"
              >{{data.indexLaitiersPere.id ?'Modifier' : 'Valider'}}</el-button>
              <el-button type="danger" plain icon="el-icon-remove" @click="deleteindexP">Annuler</el-button>
              <!-- <el-button
                v-show="0==1"
                type="danger"
                plain
                icon="el-icon-remove"
                @click="deleteindex"
              >Archiver</el-button>-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- -------------------- -->
    <div class="card mb-5 pb-2 ">
      <div class="card-header ">
        Index Fonctionnels du Pére
      </div>
      <div class="card-body">
        <div
          class="row md:flex md:justify-between"
        >
          <div class="col-9 row">
            <div
              v-for="(value,proprty,index) in data.indexfonctionnelsPere"
              :key="index"
              class="mb-3 col"
            >
              <label v-if="proprty !== 'pere_id' &&proprty !== 'id'" for="numero" class="fs-6 fw-normal mb-2">{{ proprty }}</label>
              <input
              :disabled="status==='show'"
                v-if="proprty !== 'pere_id' &&proprty !== 'id'"
                id="numero"
                v-model="data.indexfonctionnelsPere[proprty]"
                type="text"
                class="form-control"
              />
            </div>
          </div>
          <div class="col-3 row">
            <div class="mt-2 col align-items-center d-flex">
              <el-button
                type="success"
                icon="el-icon-check"
                @click="validIndex('api/Indexfonctionnelsperes/' , data.indexfonctionnelsPere) "
              >{{data.indexfonctionnelsPere.id ?'Modifier' : 'Valider'}}</el-button>
              <el-button type="danger" plain icon="el-icon-remove" @click="deleteindexF">Annuler</el-button>
              <!-- <el-button
                v-show="0==1"
                type="danger"
                plain
                icon="el-icon-remove"
                @click="deleteindex"
              >Archiver</el-button>-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ------------------- -->
    <div class="card mb-5 pb-2">
      <div class="card-header">
        Index Morphologiques Pére
      </div>
      <div class="card-body">
        <div
          class="row md:flex md:justify-between"
        >
          <div class="col-9 row">
            <div
              v-for="(value,proprty,index) in data.indexMorphologiquesPere"
              :key="index"
              class="mb-3 col"
            >
              <label v-if="proprty !== 'pere_id' &&proprty !== 'id'" for="numero" class="fs-6 fw-normal mb-2">{{ proprty }}</label>
              <input
                v-if="proprty !== 'pere_id' &&proprty !== 'id'"
                id="numero"
                :disabled="status==='show'"
                v-model="data.indexMorphologiquesPere[proprty]"
                type="text"
                class="form-control"
              />
            </div>
          </div>
          <div class="col-3 row">
            <div class="mt-2 col align-items-center d-flex">
              <el-button
                type="success"
                icon="el-icon-check"
                @click="validIndex('api/Indexesmorphologiquesperes/' ,data.indexMorphologiquesPere) "
              >{{data.indexMorphologiquesPere.id ?'Modifier' : 'Valider'}}</el-button>
              <el-button type="danger" plain icon="el-icon-remove" @click="deleteindexMPH">Annuler</el-button>
              <!-- <el-button
                v-show="0==1"
                type="danger"
                plain
                icon="el-icon-remove"
                @click="deleteindex"
              >Archiver</el-button>-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from 'axios';
export default {
  name: 'SujetIndex',
  props: {
    // eslint-disable-next-line vue/require-prop-types
    sujet: {
      type: Object,
      default: () => {},
    },
    pdf: {
      type: Object,
      default: () => {},
    },
    status: {
      type: String,
    },
  },
  data() {
    return {
      data: {

        emptyCount: 0,
        indexLaitiersPere: {
          id: null,
          Lait: null,
          MG: '',
          MGkg: '',
          Prot: '',
          ProtKg: '',
          Precision: '',
          pere_id: this.sujet.pere.id,
        },
        indexfonctionnelsPere: {
          id: null,
          SCS: null,
          LONG: '',
          FERT: '',
          FN: '',
          FV: '',
          Precision: '',
          pere_id: this.sujet.pere.id,
        },
        indexMorphologiquesPere: {
          id: null,
          Devel: null,
          TypeBassin: '',
          Membres: '',
          Pis: '',
          Precision: '',
          pere_id: this.sujet.pere.id,
        },
      },
    };
  },

  watch: {
    pdf() {
      this.setValues();

    },
    deep: true,
  },

  methods: {
    validIndex(URL, obj) {
      if (this.sujet.pere.id !== null && obj.id === null) {
        // this.$emit('data', this.data);
        obj.pere_id = this.sujet.pere.id;
        this.check(obj);
        if (this.data.emptyCount + 1 !== Object.keys(obj).length - 1) {
          Axios.post(URL, obj)
            .then((res) => {
              this.$notify({
                title: 'Success',
                message: 'Indexes  pere Bien Ajoutee',
                type: 'success',
                duration: 2000,
              });

             obj.id =res.data.data.id;
              // if (URL === 'api/Indexeslaitiersperes/') {
              //   this.deleteindexP();
              // } else if (URL === 'api/Indexfonctionnelsperes/') {
              //   this.deleteindexF();
              // } else {
              //   this.deleteindexMPH();
              // }
            })
            .catch((err) => {
              this.$notify({
                title: 'Error',
                message: err,
                type: 'error',
                duration: 2000,
              });
            });
        } else {
          this.$notify({
            title: 'info',
            message: 'Index pere is empty',
            type: 'info',
            duration: 2000,
          });
        }
      } else if (this.sujet.pere.id !== null && obj.id !== null) {
        this.updateRecord(URL, obj);
      } else {
        this.$notify({
          title: 'info',
          message:
            'Le champ père doit être rempli. Ou, un père existant doit être spécifié.',
          type: 'info',
          duration: 2000,
        });
      }
    },
    check(obj) {
      this.data.emptyCount = 0;
      for (const [key, value] of Object.entries(obj)) {
        if (obj[key] === 0 || obj[key] === '' || obj[key] === 'undefined' || value) {
          this.data.emptyCount += 1;
        }
      }
    },

    deleteindexP(run) {
      this.deleteRecord(
        this.data.indexLaitiersPere.id,
        'api/Indexeslaitiersperes/',
        run
      );
      this.data.indexLaitiersPere.Lait = null;
      this.data.indexLaitiersPere['MG'] = '';
      this.data.indexLaitiersPere.id = null;
      this.data.indexLaitiersPere['MGkg'] = '';
      this.data.indexLaitiersPere['Prot'] = '';
      this.data.indexLaitiersPere['ProtKg'] = '';
      this.data.indexLaitiersPere['Precision'] = '';
    },
    deleteindexMPH(run) {
      this.deleteRecord(
        this.data.indexMorphologiquesPere.id,
        'api/Indexesmorphologiquesperes/',
        run
      );
      this.data.indexMorphologiquesPere.id = null;
      this.data.indexMorphologiquesPere.Devel = null;
      this.data.indexMorphologiquesPere.TypeBassin = '';
      this.data.indexMorphologiquesPere.Membres = '';
      this.data.indexMorphologiquesPere.Pis = '';
      this.data.indexMorphologiquesPere.Precision = '';
    },
    deleteindexF(run) {
      this.deleteRecord(
        this.data.indexfonctionnelsPere.id,
        'api/Indexfonctionnelsperes/',
        run
      );
      this.data.indexfonctionnelsPere.id = null;
      this.data.indexfonctionnelsPere.SCS = null;
      this.data.indexfonctionnelsPere.LONG = '';
      this.data.indexfonctionnelsPere.FERT = '';
      this.data.indexfonctionnelsPere.FN = '';
      this.data.indexfonctionnelsPere.Precision = '';
      this.data.indexfonctionnelsPere.FV = '';
    },
    setValues() {
      if (this.pdf.indexLAIT.length>0) {
        for (const [key, value] of Object.entries(
          this.data.indexLaitiersPere
        )) {
          this.data.indexLaitiersPere[key] = this.pdf.indexLAIT[0][key];
        }
      }
      if (this.pdf.indexFOC.length>0) {
        for (const [key, value] of Object.entries(
          this.data.indexfonctionnelsPere
        )) {
          this.data.indexfonctionnelsPere[key] = this.pdf.indexFOC[0][key];
        }
      }
      if (this.pdf.indexPHOL.length>0) {
        for (const [key, value] of Object.entries(
          this.data.indexMorphologiquesPere
        )) {
          this.data.indexMorphologiquesPere[key] = this.pdf.indexPHOL[0][key];
        }
      }
    },
    deleteRecord(id, URL, run) {

      if (this.status === 'update' && id !== null && run !== 'stop'||id !== null && run !== 'stop'  ) {
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
    updateRecord(URL, OBJ) {
      Axios.put(URL + OBJ.id, OBJ)

        .then((res) => {
          this.$notify({
            title: 'Success',
            message: 'Index Pere Bien Modifié',
            type: 'success',
            duration: 2000,
          });
          if (this.status === 'update') {
            for (const [key, value] of Object.entries(OBJ)) {
              OBJ[key] = res.data.data[key];
            }
          }
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
  border: 1px solid rgba(0,0,0,.125) !important;
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
</style>

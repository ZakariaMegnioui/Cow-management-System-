/* eslint-disable vue/valid-v-for */
<template>
  <div class="app-container">
    <!---->
    <el-form ref="form" :model="form" label-width="120px">
      <el-form-item label="Nom : ">
        <el-input
          v-model="form.Nom"
          placeholder="Nom"
          type="text"
        />
      </el-form-item>
      <el-form-item label="Prenom : ">
        <el-input
          v-model="form.Prenom"
          placeholder="Prenom"
          type="text"
        />
      </el-form-item>
      <el-form-item label="Adresse : ">
        <el-input
          v-model="form.Adresse"
          placeholder="Address"
          type="address"
        />
      </el-form-item>
      <el-form-item label="Sujet">
        <el-select v-model="form.sujet_id" placeholder="please select your zone">
          <el-option v-for="sujet in sujets" :key="sujet.id" :label="sujet.NSNIT" :value="sujet.id" />
        </el-select>
      </el-form-item>
      <!--<el-form-item label="Activity time">
        <el-col :span="11">
          <el-date-picker v-model="form.date1" type="date" placeholder="Pick a date" style="width: 100%;" />
        </el-col>
        <el-col :span="2" class="line">
          -
        </el-col>
        <el-col :span="11">
          <el-time-picker v-model="form.date2" type="fixed-time" placeholder="Pick a time" style="width: 100%;" />
        </el-col>
      </el-form-item>
      <el-form-item label="Instant delivery">
        <el-switch v-model="form.delivery" />
      </el-form-item>
      <el-form-item label="Activity type">
        <el-checkbox-group v-model="form.type">
          <el-checkbox label="Online activities" name="type" />
          <el-checkbox label="Promotion activities" name="type" />
          <el-checkbox label="Offline activities" name="type" />
          <el-checkbox label="Simple brand exposure" name="type" />
        </el-checkbox-group>
      </el-form-item>
      <el-form-item label="Resources">
        <el-radio-group v-model="form.resource">
          <el-radio label="Sponsor" />
          <el-radio label="Venue" />
        </el-radio-group>
      </el-form-item>
      <el-form-item label="Activity form">
        <el-input v-model="form.desc" type="textarea" />
      </el-form-item>-->
      <el-form-item>
        <el-button type="primary" @click="Addeleveurnaisseurs">
          Create
        </el-button>
        <el-button @click="onCancel">
          Cancel
        </el-button>
      </el-form-item>
    </el-form>
  </div>
  <!-- <pagination v-show="total>0" :total="total" :page.sync="listQuery.page" :limit.sync="listQuery.limit" @pagination="getList" /> -->
</template>

<script>
// import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import Resource from '@/api/resource';
import Axios from 'axios';
const articleResource = new Resource('articles');

export default {
  name: 'CreateEleveurnaisseurs',
  // components: { Pagination },
  filters: {
    statusFilter(status) {
      const statusMap = {
        published: 'success',
        draft: 'info',
        deleted: 'danger',
      };
      return statusMap[status];
    },
  },
  data() {
    return {
      list: null,
      total: 0,
      listLoading: true,
      listQuery: {
        page: 1,
        limit: 20,
      },
      form: {
        /* name: '',
        region: '',
        date1: '',
        date2: '',
        delivery: false,
        type: [],
        resource: '',
        desc: '',*/
        Nom: '',
        Prenom: '',
        Adresse: '',
        sujet_id: '',
      },
      sujets: [],
    };
  },
  created() {
    this.getList();
  },
  mounted() {
    // eslint-disable-next-line no-undef
    this.getSujets();
  },
  methods: {
    async getList() {
      this.listLoading = true;
      const { data } = await articleResource.list(this.listQuery);
      this.list = data.items;
      this.total = data.total;
      this.listLoading = false;
    },
    onSubmit() {
      this.$message('submit!');
    },
    onCancel() {
      this.$message({
        message: 'cancel!',
        type: 'warning',
      });
    },

    // get users function
    getSujets(){
      Axios.get('http://127.0.0.1:8000/api/Sujet')
        .then(res => {
          this.sujets = res.data.data;
        })
        .catch(err => console.log(err));
    },
    getEleveursnaisseurs(){
      Axios.get('http://127.0.0.1:8000/api/Sujet')
        .then(res => {
          this.sujets = res.data.data;
        })
        .catch(err => console.log(err));
    },
    // add eleveurnaisseurs
    Addeleveurnaisseurs(){
      Axios.post('http://127.0.0.1:8000/api/Eleveursnaisseurs', this.form)
        .then(res => {
          console.log(res);
          this.$message({
            message: 'Eleveursnaisseurs Added',
            type: 'success',
          });
        })
        .catch(err => console.log(err));
    },
  },

};

</script>

<style scoped>
.edit-input {
  padding-right: 100px;
}
.cancel-btn {
  position: absolute;
  right: 15px;
  top: 10px;
}
</style>

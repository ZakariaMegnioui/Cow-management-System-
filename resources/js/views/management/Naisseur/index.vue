<template>
  <div class="app-container" style="padding: 0 3.2rem;">
    <!-- Static-->
    <div id="stat">
      <el-row :gutter="40" class="panel-group">
        <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
          <div class="card-panel">
            <div class="card-panel-icon-wrapper icon-people">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-12 w-12 text-indigo-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"
                />
              </svg>
            </div>
            <div class="card-panel-description">
              <div class="card-panel-text">Total</div>
              <count-to
                :start-val="0"
                :end-val="Number(count.CountEleveursnaisseurs)"
                :duration="2600"
                class="card-panel-num"
              />
            </div>
          </div>
        </el-col>
        <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
          <div class="card-panel" >
            <div class="card-panel-icon-wrapper icon-message">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-12 w-12 text-green-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"
                />
              </svg>
            </div>
            <div class="card-panel-description">
              <div class="card-panel-text">Active</div>
              <count-to
                :start-val="0"
                :end-val="Number(count.CountActive)"
                :duration="3000"
                class="card-panel-num"
              />
            </div>
          </div>
        </el-col>
        <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
          <div class="card-panel" >
            <div class="card-panel-icon-wrapper icon-money">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-12 w-12 text-indigo-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"
                />
              </svg>
            </div>
            <div class="card-panel-description">
              <div class="card-panel-text">Deactive</div>
              <count-to
                :start-val="0"
                :end-val="Number(count.CountArchive)"
                :duration="3200"
                class="card-panel-num"
              />
            </div>
          </div>
        </el-col>
        <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
          <div class="card-panel" >
            <div class="card-panel-icon-wrapper icon-shopping">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-12 w-12 text-indigo-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                />
              </svg>
            </div>
            <div class="card-panel-description">
              <div class="card-panel-text">Region</div>
              <count-to
                :start-val="0"
                :end-val="Number(count.CountRegions)"
                :duration="3600"
                class="card-panel-num"
              />
            </div>
          </div>
        </el-col>
      </el-row>
    </div>
    <el-card class="box-card">
      <!-- filter section-->
      <div>
        <div class="row">
          <!-- <div class="col-sm-5 col-md-4"></div> -->
          <div class="col-sm-6 offset-sm-2 col-md-12 offset-md-0">
            <div class="filter-container float-end">
              <el-select
                ref="select"
                v-model="value"
                class="filter-item"
                placeholder="Colums"
                @change="reviewr(value)"
              >
                <el-option
                  v-for="item in options"
                  :key="item.value"
                  :label="item.label"
                  :value="item.value"
                />
              </el-select>
              <el-button
                v-waves
                :loading="downloadLoading"
                class="filter-item"
                type="primary"
                icon="el-icon-download"
                @click="handleDownload('my-table')"
              >{{ $t('table.export') }}</el-button>
              <el-button
                v-waves
                :loading="downloadLoading"
                class="filter-item"
                type="primary"
                icon="el-icon-download"
                @click="handleDownload('my-table')"
              >import</el-button>
              <el-button
                class="filter-item myFilter"
                style="background-color:#48da89;color:#ffff;border-color:#1f9d57;"
                @click="handleCreate()"
              >

                Declaration
                <i class="el-icon-plus el-icon--left">
                  <!---->
                </i>
              </el-button>
            </div>
          </div>
          <div class="col-sm-6 offset-sm-2 col-md-12 offset-md-0">
            <el-form :inline="true" :model="search" class="demo-form-inline float-end -mr-3">
              <el-form-item label>
                <el-date-picker
                  v-model="search.DateD"
                  type="datetime"
                  class="filter-item"
                  placeholder="Date Debut"
                />
              </el-form-item>
              <el-form-item label>
                <el-date-picker
                  v-model="search.DateF"
                  type="datetime"
                  class="filter-item"
                  placeholder="Date Fin"
                />
              </el-form-item>
              <el-form-item>
                <el-button
                  v-waves
                  class="filter-item"
                  type="primary"
                  icon="el-icon-search"
                  @click="getNaisseurs(search.DateD,search.DateF)"
                >{{ $t('table.search') }}</el-button>
                <!--<el-button class="filter-item" style="margin-left: 10px;" type="primary" icon="el-icon-edit" @click="handleCreate">
              {{ $t('table.add') }}
                </el-button>-->
                <el-button
                  v-waves
                  :loading="downloadLoading"
                  class="filter-item"
                  type="danger"
                  icon="el-icon-close"
                  @click="clear"
                >clair</el-button>
              </el-form-item>
            </el-form>
          </div>
        </div>
      </div>
      <!-- My Table Good-Table-Vuejs  -->
      <div>
        <vue-good-table
          ref="my-table"
          :select-options="{
          enabled: true,
          selectOnCheckboxOnly: true,
        }"
          :columns="columns"
          :isLoading="isLoadiing"
          :rows="rows"
          theme="polar-bear"
          :pagination-options="{
          enabled: true
        }"
        >
          <!-- <div slot="selected-row-actions">
          <button class="btn btn__small btn__flat" @click="lockAll('my-table')">Lock All </button>
          </div>-->
          <template slot="table-row" slot-scope="props">
            <span v-if="props.column.field == 'Action'">
              <el-col :span="12">
                <el-dropdown trigger="click">
                  <span class="el-dropdown-link">
                    <i class="el-icon-more-outline el-icon--right rotate">
                      <!---->
                    </i>
                  </span>
                  <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item icon="el-icon-document">
                      <el-button class="Action_btn" size="mini">Details</el-button>
                    </el-dropdown-item>
                    <el-dropdown-item icon="el-icon-edit-outline">
                      <el-button
                        class="Action_btn"
                        size="mini"
                        @click="handleUpdate(props.row)"
                      >Modification</el-button>
                    </el-dropdown-item>
                    <el-dropdown-item
                      v-if="props.row.Etat === 'Active'"
                      icon="el-icon-takeaway-box"
                    >
                      <el-button class="Action_btn" @click="handleDelete(props.row)">Deactive</el-button>
                    </el-dropdown-item>
                    <el-dropdown-item
                      v-else-if=" props.row.Etat === 'Deactive'"
                      icon="el-icon-circle-check"
                    >
                      <el-button class="Action_btn" @click="ActivateNaisseur(props.row)">Active</el-button>
                    </el-dropdown-item>
                  </el-dropdown-menu>
                </el-dropdown>
              </el-col>
            </span>
            <!-- Etat -->
            <span
              v-else-if="props.column.label == 'Etat'"
              class="flex justify-center align-items-center"
            >
              <span v-if="props.row.Etat === 'Active'" class="badge bg-success">{{ props.row.Etat }}</span>
              <span v-else class="badge bg-danger">{{ props.row.Etat }}</span>
            </span>
            <span v-else>{{ props.formattedRow[props.column.field] }}</span>
          </template>
        </vue-good-table>
      </div>

      <!-- Form update-->
      <el-dialog :title="textMap[dialogStatus]" :visible.sync="dialogFormVisible" width="30%">
        <el-form
          ref="dataForm"
          :rules="rules"
          hlight-current-row
          :model="temp"
          label-position="left"
          label-width="70px"
          style="width: 400px; margin-left:50px;"
        >
          <el-form-item label="Nom" prop="Nom">
            <el-input v-model="temp.Nom" placeholder="Nom" />
          </el-form-item>
          <el-form-item label="Prenom" prop="Prenom">
            <el-input v-model="temp.Prenom" placeholder="Prenom" />
          </el-form-item>
          <el-form-item label="Adresse" prop="Adresse">
            <el-input v-model="temp.Adresse" type="address" placeholder="Adresse" />
          </el-form-item>
          <el-form-item label="CIN" prop="CIN">
            <el-input v-model="temp.CIN" placeholder="CIN" />
          </el-form-item>
          <!--<el-form-item label="Sujet" prop="sujet">
          <el-select ref="select" v-model="temp.sujet_id" class="filter-item" placeholder="Sujet">
            <el-option v-for="item in sujets" :key="item.id" :label="item.NSNIT" :value="item.id" />
          </el-select>
          </el-form-item>-->
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible = false">{{ $t('table.cancel') }}</el-button>
          <el-button
            type="primary"
            @click="dialogStatus==='create'?createData():updateData()"
          >{{ $t('table.confirm') }}</el-button>
        </div>
      </el-dialog>

      <el-dialog :visible.sync="dialogPvVisible" title="Reading statistics">
        <el-table :data="pvData" border fit highlight-current-row style="width: 100%">
          <el-table-column prop="key" label="Channel" />
          <el-table-column prop="pv" label="Pv" />
        </el-table>
        <span slot="footer" class="dialog-footer">
          <el-button type="primary" @click="dialogPvVisible = false">{{ $t('table.confirm') }}</el-button>
        </span>
      </el-dialog>
    </el-card>
  </div>
</template>

<script>
import { fetchPv } from '@/api/article';
import waves from '@/directive/waves'; // Waves directive
import { parseTime } from '@/utils';
import moment from 'moment';
import CountTo from 'vue-count-to';
// flatPicker for Good table
import flatPickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.css';
import 'flatpickr/dist/themes/material_blue.css';

import Axios from 'axios';

export default {
  name: 'Naisseur',
  // eslint-disable-next-line vue/no-unused-components
  components: { CountTo, flatPickr },
  directives: { waves },
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
      columns: [

        {
          label: 'Nom',
          field: 'Nom',
          tdClass: 'text-center',
              thClass: 'text-center',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By Nom',
          },
        },
        {
          label: 'Prenom',
          field: 'Prenom',
          tdClass: 'text-center',
              thClass: 'text-center',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By Prenom',
          },
        },
        {
          label: 'Region',
          field: 'Adresse',
          tdClass: 'text-center',
              thClass: 'text-center',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By Adresse',
          },
        },
        {
          label: 'Sujet',
          field: 'sujets_count',
          tdClass: 'text-center',
              thClass: 'text-center',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By Sujet Number',
          },
        },

        {
          label: 'Etat',
          field: 'Etat',
          tdClass: 'text-center',
          thClass: 'text-center',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By Etat',
            filterDropdownItems: ['Active', 'Archive'],
          },
        },
        {
          label: 'Date Creation',
          field: 'created_at',
          thClass: 'text-center',
          tdClass: 'text-center',
              thClass: 'text-center',
          type: 'date',
          hidden: true,
          dateInputFormat: 'yyyy-MM-dd HH:mm:ss',
          dateOutputFormat: 'yyyy-MM-dd HH:mm:ss',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter Date Creation',
            filterFn: this.dateRangeFilter,
          },
        },
        {
          label: 'Date Modification',
          field: 'updated_at',
          tdClass: 'text-center',
              thClass: 'text-center',
          type: 'date',
          hidden: true,
          dateInputFormat: 'yyyy-MM-dd HH:mm:ss',
          dateOutputFormat: 'yyyy-MM-dd HH:mm:ss',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter Date Modification',
            filterFn: this.dateRangeFilter,
          },
        },
        {
          label: 'Date Supprition',
          field: 'deleted_at',
          type: 'date',
          tdClass: 'text-center',
              thClass: 'text-center',
          hidden: true,
          dateInputFormat: 'yyyy-MM-dd HH:mm:ss',
          dateOutputFormat: 'yyyy-MM-dd HH:mm:ss',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter Date Supprition',
            filterFn: this.dateRangeFilter,
          },
        },
            {
          label: 'CIN',
          field: 'CIN',
           hidden: true,
          tdClass: 'text-center',
             thClass: 'text-center',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By CIN',
          },
        },

        {
          label: 'Action',
          field: 'Action',
          sortable: false,
          tdClass: 'text-end ',
          // html: true,
        },
      ],
      rows: [],
      options: [
        { label: 'Columns', value: 0 },
           { label: 'CIN', value: 4},
        { label: 'Date Creation', value: 1 },
        { label: 'Date Modification', value: 2 },
        { label: 'Date Supprition', value: 3 },

      ],

      Types: [
        { label: 'Vache', value: 'Vache' },
        { label: 'Veau', value: 'Veau' },
      ],
      // Sexes: [{ label: 'M', value: 'M' }, { label: 'F', value: 'F' }],
      value: 0,
      showReviewer: false,
      temp: {
        Nom: '',
        Prenom: '',
        Adresse: '',
        CIN: '',
      },
      dialogFormVisible: false,
      dialogStatus: '',
      textMap: {
        update: 'Edit',
        create: 'Create',
      },
      dialogPvVisible: false,
      pvData: [],
      rules: {
        /*  type: [{ required: true, message: 'type is required', trigger: 'change' }],
        timestamp: [{ type: 'date', required: true, message: 'timestamp is required', trigger: 'change' }],
        title: [{ required: true, message: 'title is required', trigger: 'blur' }],*/
      },
      downloadLoading: false,
      sujets: [],
      ExpTable: [],
      search: {
        DateD: '',
        DateF: '',
        search: '',
      },
      isLoadiing: false,
      ArchiveN: {},
      ActiveN: {},
      RegionsDist: [],
      count: {
        CountUsers: 0,
        CountSujets: 0,
        CountEleveursnaisseurs: 0,
        CountArchive: 0,
        CountActive: 0,
        CountRegions: 0,
      },
    };
  },
  mounted() {
    const inputs = [
      'input[placeholder="Filter DateNaissance"]',
      'input[placeholder="Filter Date Modification"]',
      'input[placeholder="Filter Date Creation"]',
      'input[placeholder="Filter Date Supprition"]',
    ];
    inputs.forEach(function (input) {
      flatPickr(input, {
        dateFormat: 'm-d-Y',
        mode: 'range',
        allowInput: true,
      });
    });
    // eslint-disable-next-line no-undef
    this.getNaisseurs('', '');
    this.getSujets();
    // this.getArchiveCount();
  },
  created() {},
  methods: {
    reviewr(value) {
      if (value !== null) {
        if (value === 1) {

          this.columns[5].hidden = false;
          this.columns[6].hidden = true;
          this.columns[7].hidden = true;
            this.columns[8].hidden = true;
          // console.log(this.columns[7].hidden);
        } else if (value === 2) {
          this.columns[5].hidden = true;
          this.columns[6].hidden = false;
          this.columns[7].hidden = true;
            this.columns[8].hidden = true;
          // console.log(this.columns[8].hidden);
        } else if (value === 3) {
          this.columns[5].hidden = true;
          this.columns[6].hidden = true;
          this.columns[7].hidden = false;
          this.columns[8].hidden = true;
         } else if (value === 4) {
          this.columns[5].hidden = true;
          this.columns[6].hidden = true;
          this.columns[7].hidden = true;
           this.columns[8].hidden = false;
        }else{
          this.columns[5].hidden = true;
          this.columns[6].hidden = true;
          this.columns[7].hidden = true;
          this.columns[8].hidden = true;
        }
       console.log(value)
      }
    },
    clear() {
      // eslint-disable-next-line no-sequences
      this.search.DateD = '';
      this.search.DateF = '';
      this.search.search = '';
      this.getNaisseurs('', '');
    },
    handleCreate() {
      this.dialogStatus = 'create';
      this.dialogFormVisible = true;
      this.temp.timestamp = new Date(this.temp.timestamp);
      this.$nextTick(() => {
        this.$refs['dataForm'].clearValidate();
      });
    },
    createData() {
      this.$refs['dataForm'].validate((valid) => {
        if (valid) {
          const tempData = Object.assign({}, this.temp);
          console.log(tempData);
          Axios.post('http://127.0.0.1:8000/api/Eleveursnaisseurs/', tempData)
            .then((res) => {
              this.getNaisseurs('', '');
              this.temp = {};
              this.dialogFormVisible = false;
              this.$notify({
                title: 'Success',
                message: res.data.Msg,
                type: 'success',
                duration: 2000,
              });
              console.log(res.data.data)
            })
            // eslint-disable-next-line handle-callback-err
            .catch((err) => {
              console.log(err);
              this.$notify({
                title: 'Error',
                message: err,
                type: 'info',
                duration: 2000,
              });
            });
          // });
        }
      });
    },
    dateRangeFilter(data, filterString) {
      const dateRange = filterString.split('to');
      const startDate = Date.parse(dateRange[0]);
      const endDate = Date.parse(dateRange[1]);
      return (data =
        Date.parse(data) >= startDate && Date.parse(data) <= endDate);
    },
    handleUpdate(row) {
      this.temp = Object.assign({}, row); // copy obj
      this.temp.timestamp = new Date(this.temp.timestamp);
      this.dialogStatus = 'update';
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['dataForm'].clearValidate();
      });
    },
    updateData() {
      this.$refs['dataForm'].validate((valid) => {
        if (valid) {
          const tempData = Object.assign({}, this.temp);
          console.log(tempData);
          Axios.put(
            'http://127.0.0.1:8000/api/Eleveursnaisseurs/' + tempData.id,
            tempData
          )
            .then((res) => {
              this.getNaisseurs('', '');
              this.dialogFormVisible = false;
              this.$notify({
                title: 'Success',
                message: res.data.Msg,
                type: 'success',
                duration: 2000,
              });
            })
            // eslint-disable-next-line handle-callback-err
            .catch((err) => {
              this.$notify({
                title: 'Error',
                message: err,
                type: 'info',
                duration: 2000,
              });
            });
        }
      });
    },
    handleDelete(row) {
      Axios.delete('http://127.0.0.1:8000/api/Eleveursnaisseurs/' + row.id)
        .then((res) => {
          this.getNaisseurs('', '');
          this.dialogFormVisible = false;
          console.log(res);
          this.$notify({
            title: 'Success',
            message: 'Naisseur Archiver',
            type: 'success',
            duration: 2000,
          });
        })
        // eslint-disable-next-line handle-callback-err
        .catch((err) => {
          this.$notify({
            title: 'Error',
            message: err,
            type: 'info',
            duration: 2000,
          });
        });
    },
    handleFetchPv(pv) {
      fetchPv(pv).then((response) => {
        this.pvData = response.data.pvData;
        this.dialogPvVisible = true;
      });
    },
    handleDownload() {
      this.downloadLoading = true;
      import('@/vendor/Export2Excel').then((excel) => {
        const tHeader = [
          'ID',
          'Nom',
          'Prenom',
          'Adresse',
          'Etat',
          'Date Creation',
          'Date Modification',
          'Date Supprition',
        ];
        const filterVal = [
          'id',
          'Nom',
          'Prenom',
          'Adresse',
          'Etat',
          'created_at',
          'updated_at',
          'deleted_at',
        ];
        // Export just seleceted Rows in table
        this.ExpTable = this.$refs['my-table'].selectedRows;
        const data = this.formatJson(filterVal, this.ExpTable);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'Naisseurs-list',
        });
        this.downloadLoading = false;
      });
    },
    formatJson(filterVal, jsonData) {
      return jsonData.map((v) =>
        filterVal.map((j) => {
          if (j === 'DateNaissance') {
            return parseTime(v[j]);
          } else {
            return v[j];
          }
        })
      );
    },

    getNaisseurs(DateD, DateF) {
      // eslint-disable-next-line eqeqeq
      this.isLoadiing = true;
      if (DateD == '' && DateF == '') {
        Axios.get('http://127.0.0.1:8000/api/Eleveursnaisseurs')
          .then((res) => {
            this.rows = res.data.data;
            this.isLoadiing = false;
            // console.log(this.rows);
            // Statistics
            this.count.CountEleveursnaisseurs = this.rows.length;
            this.ArchiveN = this.rows.filter((ele) =>
              ele.Etat === 'Deactive' ? ele : ''
            );
            this.ActiveN = this.rows.filter((ele) =>
              ele.Etat === 'Active' ? ele : ''
            );
            this.RegionsDist = [
              ...new Set(this.rows.map((ele) => ele.Adresse)),
            ];
            this.count.CountArchive = this.ArchiveN.length;
            this.count.CountActive = this.ActiveN.length;
            this.count.CountRegions = this.RegionsDist.length;
            for (var i = 0; i < this.rows.length; i++) {
              if (this.rows[i].created_at) {
                this.rows[i].created_at = moment(
                  String(this.rows[i].created_at)
                ).format('yyyy-MM-DD HH:mm:ss');
              }
              if (this.rows[i].updated_at) {
                this.rows[i].updated_at = moment(
                  String(this.rows[i].updated_at)
                ).format('yyyy-MM-DD HH:mm:ss');
              }
              if (this.rows[i].deleted_at) {
                this.rows[i].deleted_at = moment(
                  String(this.rows[i].deleted_at)
                ).format('yyyy-MM-DD HH:mm:ss');
              }
            }
          })
          .catch((err) => console.log(err));
      } else if (DateD !== '' && DateF !== '') {
        DateD = moment(String(DateD)).format('yyyy-MM-DD');
        DateF = moment(String(DateF)).format('yyyy-MM-DD');
        console.log(DateF);
        Axios.get(
          `http://127.0.0.1:8000/api/Eleveursnaisseurs?dateD=${DateD}&dateF=${DateF}`
        )
          .then((res) => {
            // console.log(res.data.data);
            this.rows = res.data.data;

            for (var i = 0; i < this.rows.length; i++) {
              if (this.rows[i].created_at) {
                this.rows[i].created_at = moment(
                  String(this.rows[i].created_at)
                ).format('yyyy-MM-DD HH:mm:ss');
              }
              this.rows[i].updated_at = moment(
                String(this.rows[i].updated_at)
              ).format('yyyy-MM-DD HH:mm:ss');
              this.rows[i].deleted_at = moment(
                String(this.rows[i].deleted_at)
              ).format('yyyy-MM-DD HH:mm:ss');
            }
          })
          .catch((err) => console.log(err));
      }
    },

    // get Sujets.
    getSujets() {
      // eslint-disable-next-line eqeqeq
      Axios.get('http://127.0.0.1:8000/api/Sujet')
        .then((res) => {
          this.sujets = res.data.data;
          // console.log(this.sujets);
        })
        .catch((err) => console.log(err));
    },
    ActivateNaisseur(row) {
      Axios.put('http://127.0.0.1:8000/api/ActivateNaisseur/' + row.id)
        .then((res) => {
          this.getNaisseurs('', '');
          this.dialogFormVisible = false;
          console.log(res);
          this.$notify({
            title: 'Success',
            message: 'Naisseur Activer',
            type: 'success',
            duration: 2000,
          });
        })
        // eslint-disable-next-line handle-callback-err
        .catch((err) => {
          this.$notify({
            title: 'Error',
            message: err,
            type: 'info',
            duration: 2000,
          });
        });
    },
  },
};
</script>

<style scoped>
.international-icon {
  font-size: 20px;
  cursor: pointer;
  vertical-align: -5px !important;
}
</style>

<style rel="stylesheet/scss" lang="scss" scoped>
.panel-group {
  margin-top: 18px;

  .card-panel-col {
    margin-bottom: 32px;
    box-shadow: 1px 1px 10px rgba(0, 0, 0, 0) !important;
  }
  .card-panel {
    height: 108px;
    cursor: pointer;
    font-size: 12px;
    position: relative;
    overflow: hidden;
    color: #666;
    background: #fff;
    box-shadow: 4px 4px 40px rgba(0, 0, 0, 0.05);
    border-color: rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.123) !important;
    border-radius: 0.5rem !important;
    overflow: hidden !important;

    &:hover {
      .card-panel-icon-wrapper {
        color: #fff;
      }
      .icon-people {
        background: #40c9c6;
      }
      .icon-message {
        background: #40c9c6;
      }
      .icon-money {
        background: #40c9c6;
      }
      .icon-shopping {
        background: #34bfa3;
        color: #131414;
      }
    }
    .icon-people {
      color: #676b6b;
    }
    .icon-message {
      color: #36a3f7;
    }
    .icon-money {
      color: #f4516c;
    }
    .icon-shopping {
      color: #131414;
    }
    .card-panel-icon-wrapper {
      float: left;
      margin: 14px 0 0 14px;
      padding: 16px;
      transition: all 0.38s ease-out;
      border-radius: 6px;
    }
    .card-panel-icon {
      float: left;
      font-size: 48px;
    }
    .card-panel-description {
      float: right;
      font-weight: bold;
      margin: 26px;
      margin-left: 0px;
      .card-panel-text {
        line-height: 18px;
        color: rgba(0, 0, 0, 0.45);
        font-size: 16px;
        margin-bottom: 12px;
      }
      .card-panel-num {
        font-size: 20px;
      }
    }
  }
}
// Action dropdown style
.text-center {
  text-align: center !important;
}
.rotate {
  transform: rotate(90deg);
}
.Action_btn {
  border: none;
  background: transparent;
  background-color: transparent;
  font-size: 12px;
}
.el-dropdown-link {
  cursor: pointer;
  color: #37393b;
}
.el-icon-arrow-down {
  font-size: 12px;
}
.demonstration {
  display: block;
  color: #8492a6;
  font-size: 14px;
  margin-bottom: 20px;
}
.el-button.el-button--primary {
  background-color: #7367f0 !important;
  border-color: #7367f0 !important;
}
.el-button.el-button--danger {
  background-color: #ea5455 !important;
  border-color: #ea5455 !important;
}
.el-button.el-button--success {
  background-color: #28c76f !important;
  border-color: #28c76f !important;
}

.el-button.el-button--success:hover,
.el-button.el-button--success:focus {
  background-color: #1f9d57 !important;
  border-color: #28c76f !important;
}
.el-button.el-button--danger:hover,
.el-button.el-button--danger:focus {
  background-color: #e42728 !important;
  border-color: #ea5455 !important;
}
.el-button.el-button--primary:hover,
.el-button.el-button--primary:focus {
  background-color: #4839eb !important;
  border-color: #7367f0 !important;
}
</style>


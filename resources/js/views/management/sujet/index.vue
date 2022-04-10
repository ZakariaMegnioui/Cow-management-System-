<template>
  <div class="app-container" style="padding: 0 3.2rem;">
    <!-- Static-->
    <div id="stat container">
      <el-row :gutter="40" class="panel-group">
        <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
          <div class="card-panel" >
            <div class="card-panel-icon-wrapper icon-people">
              <a href="https://www.freeiconspng.com/img/5749" title="Image from freeiconspng.com">
                <img
                  src="https://www.freeiconspng.com/uploads/financial-icon-png-7.png"
                  width="60"
                  alt="Financial Hd Icon"
                />
              </a>
            </div>
            <div class="card-panel-description">
              <div class="card-panel-text">Total</div>
              <count-to
                :start-val="0"
                :end-val="Number(count.CountSujets)"
                :duration="2600"
                class="card-panel-num"
              />
            </div>
          </div>
        </el-col>
        <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
          <div class="card-panel" >
            <div class="card-panel-icon-wrapper icon-message">
              <a href="https://www.freeiconspng.com/img/2782" title="Image from freeiconspng.com">
                <img
                  src="https://www.freeiconspng.com/uploads/farmer-agriculture-icon-6.png"
                  width="60"
                  alt="Farmer Agriculture Icon"
                />
              </a>
            </div>
            <div class="card-panel-description">
              <div class="card-panel-text">Naisseur</div>
              <count-to
                :start-val="0"
                :end-val="Number(count.CountEleveursnaisseurs)"
                :duration="3000"
                class="card-panel-num"
              />
            </div>
          </div>
        </el-col>
        <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
          <div class="card-panel">
            <div class="card-panel-icon-wrapper icon-money">
              <a href="https://www.freeiconspng.com/img/1694" title="Image from freeiconspng.com">
                <img
                  src="https://www.freeiconspng.com/uploads/executive-person-icon--icon-search-engine-27.png"
                  width="60"
                  alt="Vector Icon Person"
                />
              </a>
            </div>
            <div class="card-panel-description">
              <div class="card-panel-text">Proprietaires</div>
              <count-to
                :start-val="0"
                :end-val="Number(count.CountEleveurproprietaires)"
                :duration="3200"
                class="card-panel-num"
              />
            </div>
          </div>
        </el-col>
        <el-col :xs="12" :sm="12" :lg="6" class="card-panel-col">
          <div class="card-panel" >
            <div class="card-panel-icon-wrapper icon-shopping">
              <a href="https://www.freeiconspng.com/img/19051" title="Image from freeiconspng.com">
                <img
                  src="https://www.freeiconspng.com/uploads/science-icon-10.png"
                  width="60"
                  alt="Icon Transparent Science"
                />
              </a>
            </div>
            <div class="card-panel-description">
              <div class="card-panel-text">Race</div>
              <count-to
                :start-val="0"
                :end-val="Number(count.CountRaces)"
                :duration="3600"
                class="card-panel-num"
              />
            </div>
          </div>
        </el-col>
      </el-row>
    </div>
    <!-- filter section-->
    <el-card class="box-card">
    <div class=" ">
      <div class="row">
        <div class="col-sm-5 col-md-4">
          <!---->
        </div>
        <div class="col-sm-6 offset-sm-2 col-md-8 offset-md-0">
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
            <!-- <el-button @click="Redirect(1)">
              pdf
            </el-button> -->
            <el-button
              v-waves
              :loading="downloadLoading"
              class="filter-item"
              type="primary"
              icon="el-icon-download"
              @click="handelExport('my-table')"
            >{{ $t('table.export') }}</el-button>
            <el-button
              v-waves
              :loading="downloadLoading"
              class="filter-item"
              type="primary"
              icon="el-icon-download"
              @click="handelImport('my-table')"
            >import</el-button>

            <el-button
              class="filter-item myFilter"
              style="background-color:#48da89;color:#ffff;border-color:#1f9d57;"
              @click="RedirectToShow()"
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
                @click="getSujets(search.DateD,search.DateF)"
              >{{ $t('table.search') }}</el-button>
              <el-button
                v-waves
                :loading="downloadLoading"
                class="filter-item"
                type="danger"
                icon="el-icon-close"
                @click="clear"
              >Clair</el-button>
            </el-form-item>
          </el-form>
        </div>
      </div>
      <!--row-->
    </div>
    <!-- My Table Good-Table-Vuejs  -->
    <div>
      <vue-good-table
        ref="my-table"
        :isLoading="isLoadiing"
        :select-options="{
          enabled: true,
          selectOnCheckboxOnly: true,
        }"
        :columns="columns"
        :rows="rows"
        theme="polar-bear"
        :pagination-options="{
          enabled: true
        }"
      >
        <template slot="table-row" slot-scope="props">
          <!-- Actions --->
          <span
            v-if="props.column.field == 'Action'"
            class="d-flex justify-content-between align-items-center"
          >
            <el-col :span="12">
              <el-dropdown trigger="click">
                <span class="el-dropdown-link">
                  <i class="el-icon-more-outline el-icon--right rotate">
                    <!---->
                  </i>
                </span>
                <el-dropdown-menu slot="dropdown">
                  <el-dropdown-item icon="el-icon-view">
                    <el-button
                      type="submit"
                      class="Action_btn"
                      size="mini"
                      @click="RedirectToShow(props.row.id,'show')"
                    >Voir</el-button>
                  </el-dropdown-item>
                  <el-dropdown-item icon="el-icon-edit-outline">
                    <el-button
                      type="submit"
                      class="Action_btn"
                      size="mini"
                      @click="RedirectToShow(props.row.id,'update')"
                    >Modifier</el-button>
                  </el-dropdown-item>

                  <el-dropdown-item icon="el-icon-check">
                    <el-button
                      type="submit"
                      class="Action_btn"
                      size="mini"
                      @click="sujetData4pdf(props.row.id)"
                    >CartGrise</el-button>
                  </el-dropdown-item>
                  <el-dropdown-item v-if="props.row.Etat === 'Active'" icon="el-icon-right">
                    <el-button type="submit" class="Action_btn" @click="Sort(props.row.id)">Sorte</el-button>
                  </el-dropdown-item>
                  <el-dropdown-item v-else-if=" props.row.Etat === 'Sorte'" icon="el-icon-back">
                    <el-button
                      type="submit"
                      class="Action_btn"
                      @click="ActivateSujet(props.row.id)"
                    >Restaurer</el-button>
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
    <!-- Sort Modal -->
    <!-- Modal -->
    <el-dialog title="Sorte" :visible.sync="dialogFormSort">
      <el-form label-position="left">
        <el-form-item label="Cause">
          <el-select
            v-model="sortData.SortValue"
            multiple
            filterable
            allow-create
            default-first-option
            placeholder="Entrez la raison de la sortie"
          >
            <el-option
              v-for="item in SortCaus"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>

        <el-form-item label="Info Cause">
          <el-input
            v-model="sortData.infoCause"
            :autosize="{ minRows: 2, maxRows: 4}"
            type="textarea"
            placeholder="Entrez les informations de sortie"
          />
        </el-form-item>
      </el-form>
      <!-- Start Button -->
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogFormSort = false">Cancel</el-button>
        <el-button type="danger" @click="handleDelete(selectedRowId)">Sort</el-button>
        <!-- End Button -->
      </span>
    </el-dialog>
    <CartGrise v-if="open" :pdf-data="pdfData" @hasGenerated='hasGenerated' />
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
import CartGrise from './PdfGenerator';

import Axios from 'axios';

export default {
  name: 'Sujet',
  // eslint-disable-next-line vue/no-unused-components
  components: { CountTo, flatPickr, CartGrise },
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
      open: false,
      pdfData: {},
      columns: [
        {
          label: 'Reference',
          field: 'NTravail',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By NTravail',
          },
        },
        {
          label: 'NSNIT',
          field: 'NSNIT',
           tdClass:"text-center",
               thClass: 'text-center',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By NSNIT',
          },
          // type: 'number',
        },
        {
          label: 'DateNaissance',
          field: 'DateNaissance',
          tdClass:"text-center",
              thClass: 'text-center',
          filterable: true,
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd',
          dateOutputFormat: 'yyyy-MM-dd',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter DateNaissance',
            filterFn: this.dateRangeFilter,
          },
        },
        {
          label: 'Race',
          field: 'Race',
           tdClass:"text-center",
               thClass: 'text-center',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By Race',
            // eslint-disable-next-line valid-typeof
            filterDropdownItems:
              [] /* this.Races.filter((ele) => typeof (ele) !== 'object' ? ele : '') */,
          },
        },
        {
          label: 'Type',
          field: 'Type',
           tdClass:"text-center",
               thClass: 'text-center',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By Type',
            filterDropdownItems: ['Vache', 'Veau'],
          },
        },
        {
          label: 'Sexe',
          field: 'Sexe',
           tdClass:"text-center",
               thClass: 'text-center',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By Sexe',
            filterDropdownItems: ['Female', 'Male'],
          },
        },
        {
          label: 'User',
          field: 'user.name',
           tdClass:"text-center",
               thClass: 'text-center',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By UserName',
          },
        },
        {
          label: 'Region',
          field: 'Adresse',
          hidden: true,
           tdClass:"text-center",
               thClass: 'text-center',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By Adresse',
          },
        },
        {
          label: 'Etat',
          field: 'Etat',
          tdClass: 'text-end ',
          html: true,
          filterOptions: {
            enabled: true,
            placeholder: 'Filter By Etat',
            filterDropdownItems: ['Active', 'Sorte'],
          },
        },
        {
          label: 'Date Creation',
          field: 'created_at',
           tdClass:"text-center",
               thClass: 'text-center',
          filterable: true,
          hidden: true,
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd HH:mm:ss',
          dateOutputFormat: 'yyyy-MM-dd HH:mm:ss',
          filterOptions: {
            enabled: true,
            placeholder: 'Filter Date_Creation',
            filterFn: this.dateRangeFilter,
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
      options: [
        { label: 'Columns', value: 0 },
        { label: 'Date Creation', value: 1 },
        { label: 'Date Modification', value: 2 },
        { label: 'Date Sort', value: 3 },
        { label: 'Region', value: 4 },
      ],

      Types: [
        { label: 'Vache', value: 'Vache' },
        { label: 'Veau', value: 'Veau' },
      ],
      Sexes: [
        { label: 'M', value: 'M' },
        { label: 'F', value: 'F' },
      ],
      value: 0,
      Declaration: null,
      rows: [],
      createdatColumn: null,
      tableKey: 0,
      list: null,
      total: 0,
      isLoadiing: false,
      listQuery: {
        page: 1,
        limit: 10,
        importance: undefined,
        title: undefined,
        type: undefined,
        sort: '+id',
      },
      importanceOptions: [1, 2, 3],
      sortOptions: [
        { label: 'ID Ascending', value: 'asc' },
        { label: 'ID Descending', value: 'desc' },
      ],
      statusOptions: ['published', 'draft', 'deleted'],
      showReviewer: false,
      temp: {
        NSNIT: '',
        DateNaissance: new Date(),
        Race: '',
        NTravail: '',
        Type: '',
        Etat: '',
        Sexe: '',
        EleveurProprietaires_ID: 1,
        EleveurNaisseurs_ID: 2,
        /* meres_ID: 'm1',
        peres_ID: 'p1',
        GrandPerePaternels_ID: 'gpp1',
        GrandPereMaternels_ID: 'gpm1',
        GrandMerePaternelles_ID: 'gmp1',
        GrandMereMaternelles_ID: 'gmm1',
        EleveurProprietaires_ID: 1,
        EleveurNaisseurs_ID: 2,*/
        /* title: '',
        type: '',
        status: 'published',*/
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
        type: [
          { required: true, message: 'type is required', trigger: 'change' },
        ],
        timestamp: [
          {
            type: 'date',
            required: true,
            message: 'timestamp is required',
            trigger: 'change',
          },
        ],
        title: [
          { required: true, message: 'title is required', trigger: 'blur' },
        ],
      },
      downloadLoading: false,
      sujets: [],
      ExpTable: [],
      search: {
        DateD: '',
        DateF: '',
        search: '',
      },
      RacesDist: [],
      count: {
        CountSujets: 0,
        CountEleveurproprietaires: 0,
        CountEleveursnaisseurs: 0,
        CountRaces: 0,
      },
      //  Sort Dialog
      dialogFormSort: false,
      SortCaus: [
        {
          value: 'Mort',
          label: 'Mort',
        },
        {
          value: 'Vendu',
          label: 'Vendu',
        },
      ],
      sortData: {
        SortValue: '',
        infoCause: '',
      },
      selectedRowId: '',
    };
  },
  mounted() {
    const inputs = [
      'input[placeholder="Filter DateNaissance"]',
      'input[placeholder="Filter Date Modification"]',
      'input[placeholder="Filter Date_Creation"]',
      'input[placeholder="Filter Date Sorte"]',
    ];
    inputs.forEach(function (input) {
      flatPickr(input, {
        dateFormat: 'm-d-Y',
        mode: 'range',
        allowInput: true,
      });
    });
    // eslint-disable-next-line no-undef
    this.getSujets('', '');
  },
  created() {
    this.getNaisseurs();
    this.getProprietaire();
  },
  methods: {
    getProprietaire() {
      Axios.get('/api/Eleveurproprietaire')
        .then((res) => {
          this.count.CountEleveurproprietaires = res.data.data.length;
        })
        .catch((err) => console.log(err));
    },
    getNaisseurs() {
      Axios.get('/api/Eleveursnaisseurs')
        .then((res) => {
          this.count.CountEleveursnaisseurs = res.data.data.length;
        })
        .catch((err) => console.log(err));
    },
    hasGenerated(e){
      this.isLoadiing=false;
    }
    ,
    sujetData4pdf(id) {
      this.isLoadiing = true;
      Axios.get('/api/PdfData/' + id + '/GET')

        .then((response) => {
          this.pdfData = response.data.Pdf;

          this.open = true;

        })
        .catch((error) => {
          console.log(error);
        });
      this.open = false;
    },
    lockAll(rows) {
      // console.log(shift.id);
      console.log(this.$refs['my-table'].selectedRows);
    },
    reviewr(value) {
      if (value !== null) {
        if (value === 0) {
          this.columns[9].hidden = false;
          this.columns[10].hidden = false;
          this.columns[11].hidden = false;
          this.columns[7].hidden = false;
        } else if (value === 1) {
          this.columns[9].hidden = false;
          this.columns[10].hidden = true;
          this.columns[11].hidden = true;
          this.columns[7].hidden = true;
        } else if (value === 2) {
          this.columns[10].hidden = false;
          this.columns[9].hidden = true;
          this.columns[11].hidden = true;
          this.columns[7].hidden = true;
        } else if (value === 3) {
          this.columns[10].hidden = true;
          this.columns[9].hidden = true;
          this.columns[7].hidden = true;
          this.columns[11].hidden = false;
        } else if (value === 4) {
          this.columns[10].hidden = true;
          this.columns[9].hidden = true;
          this.columns[11].hidden = true;
          this.columns[7].hidden = false;
        } else {
          this.columns[9].hidden = true;
          this.columns[10].hidden = true;
          this.columns[11].hidden = true;
          this.columns[7].hidden = true;
        }
        console.log(value);
      }
    },
    clear() {
      // eslint-disable-next-line no-sequences
      this.search.DateD = '';
      this.search.DateF = '';
      this.search.search = '';
      this.getSujets('', '');
    },
    handleCreate() {
      this.dialogStatus = 'create';
      this.dialogFormVisible = true;
      this.temp.timestamp = new Date(this.temp.timestamp);
      this.$nextTick(() => {
        this.$refs['dataForm'].clearValidate();
      });
    },
    // createData() {
    //   this.$refs['dataForm'].validate((valid) => {
    //     if (valid) {
    //       const tempData = Object.assign({}, this.temp);
    //       tempData.user_id = this.$userId;
    //       console.log(tempData);
    //       Axios.post('http://127.0.0.1:8000/api/Sujet/', tempData)
    //         .then((res) => {
    //           this.getSujets('', '');
    //           // this.rows.unshift(this.temp);
    //           this.temp = {};
    //           this.dialogFormVisible = false;
    //           this.$notify({
    //             title: 'Success',
    //             message: res.data.Msg,
    //             type: 'success',
    //             duration: 2000,
    //           });
    //         })
    //         // eslint-disable-next-line handle-callback-err
    //         .catch((err) => {
    //           this.$notify({
    //             title: 'Error',
    //             message: err,
    //             type: 'info',
    //             duration: 2000,
    //           });
    //         });
    //       // });
    //     }
    //   });
    // },
    // handleUpdate(row) {
    //   this.temp = Object.assign({}, row); // copy obj
    //   this.temp.timestamp = new Date(this.temp.timestamp);
    //   this.dialogStatus = 'update';
    //   this.dialogFormVisible = true;
    //   this.$nextTick(() => {
    //     this.$refs['dataForm'].clearValidate();
    //   });
    // },
    // updateData() {
    //   this.$refs['dataForm'].validate((valid) => {
    //     if (valid) {
    //       const tempData = Object.assign({}, this.temp);
    //       console.log(tempData);
    //       Axios.put('http://127.0.0.1:8000/api/Sujet/' + tempData.id, tempData)
    //         .then((res) => {
    //           // this.getSujets('', '');
    //           for (const v of this.rows) {
    //             if (v.id === this.temp.id) {
    //               const index = this.rows.indexOf(v);
    //               this.rows.splice(index, 1, this.temp);
    //               break;
    //             }
    //           }
    //           this.dialogFormVisible = false;
    //           this.$notify({
    //             title: 'Success',
    //             message: res.data.Msg,
    //             type: 'success',
    //             duration: 2000,
    //           });
    //         })
    //         // eslint-disable-next-line handle-callback-err
    //         .catch((err) => {
    //           this.$notify({
    //             title: 'Error',
    //             message: err,
    //             type: 'info',
    //             duration: 2000,
    //           });
    //         });
    //     }
    //   });
    // },
    dateRangeFilter(data, filterString) {
      const dateRange = filterString.split('to');
      const startDate = Date.parse(dateRange[0]);
      const endDate = Date.parse(dateRange[1]);
      return (data =
        Date.parse(data) >= startDate && Date.parse(data) <= endDate);
    },

    SortCause(id) {
      const tempData = Object.assign({}, this.sortData);
      Axios.put('http://127.0.0.1:8000/api/SortCause/' + id, tempData)
        .then((res) => {
          console.log(res.data.msg);

          /* this.$notify({
            title: 'Success',
            message: res.data.Msg,
            type: 'success',
            duration: 2000,
          });*/
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
    handleDelete(id) {
      console.log(this.sortData);
      // console.log(id , "-hiz my log");
      Axios.delete('http://127.0.0.1:8000/api/Sujet/' + id)
        .then((res) => {
          this.dialogFormSort = false;
          this.SortCause(id);
          this.sortData.infoCause = '';
          this.sortData.SortValue = '';
          this.getSujets('', '');
          this.$notify({
            title: 'Success',
            // message: res.data.message,
            message: 'Vache Sorte',
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
    handelImport() {},
    handelExport() {
      this.downloadLoading = true;
      import('@/vendor/Export2Excel').then((excel) => {
        const tHeader = [
          'ID',
          'NSNIT',
          'DateNaissance',
          'Race',
          'NTravail',
          'user',
          'Sexe',
          'Type',
          'Created_at',
          'Updated_at',
        ];
        const filterVal = [
          'id',
          'NSNIT',
          'DateNaissance',
          'Race',
          'NTravail',
          'username',
          'Sexe',
          'Type',
          'created_at',
          'updated_at',
        ];
        // Export just seleceted Rows in table
        this.ExpTable = this.$refs['my-table'].selectedRows;
        for (var i = 0; i < this.ExpTable.length; i++) {
          this.ExpTable[i].username =
            this.$refs['my-table'].selectedRows[i].user.name;
          // console.log(this.ExpTable[i].username);
        }
        console.log(this.$refs['my-table'].selectedRows.username);
        const data = this.formatJson(filterVal, this.ExpTable);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'Sujets-list',
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

    getSujets(DateD, DateF) {
      // eslint-disable-next-line eqeqeq
      this.isLoadiing = true;
      if (DateD == '' && DateF == '') {
        Axios.get('http://127.0.0.1:8000/api/Sujet')
          .then((res) => {
            this.rows = res.data.data;
            // Statistics
            this.count.CountSujets = this.rows.length;
            this.RacesDist = [...new Set(this.rows.map((ele) => ele.Race))];
            this.count.CountRaces = this.RacesDist.length;
            for (var i = 0; i < this.rows.length; i++) {
              if (this.rows[i].DateNaissance !== '') {
                this.rows[i].DateNaissance = moment(
                  String(this.rows[i].DateNaissance)
                ).format('yyyy-MM-DD');

              }
              if(this.rows[i].created_at){

                this.rows[i].created_at = moment(
                  String(this.rows[i].created_at)
                ).format('yyyy-MM-DD HH:mm:ss');
              }
            }
            // set All Races in Table
            // eslint-disable-next-line no-redeclare
            this.columns[3].filterOptions.filterDropdownItems = [];
            // eslint-disable-next-line no-redeclare
            for (var i = 0; i < this.rows.length; i++) {
              this.columns[3].filterOptions.filterDropdownItems.push(
                JSON.parse(JSON.stringify(this.rows[i].Race))
              );
            }
            this.isLoadiing = false;
          })
          .catch((err) => console.log(err));
      } else if (DateD !== '' && DateF !== '') {
        DateD = moment(String(DateD)).format('yyyy-MM-DD');
        DateF = moment(String(DateF)).format('yyyy-MM-DD');
        console.log(DateF);
        Axios.get(
          `http://127.0.0.1:8000/api/Sujet?dateD=${DateD}&dateF=${DateF}`
        )
          .then((res) => {
            this.rows = res.data.data;
            // Statistics
            this.count.CountSujets = this.rows.length;
            this.RacesDist = [...new Set(this.rows.map((ele) => ele.Race))];
            this.count.CountRaces = this.RacesDist.length;
            for (var i = 0; i < this.rows.length; i++) {
              if (this.rows[i].DateNaissance !== '') {
                this.rows[i].DateNaissance = moment(
                  String(this.rows[i].DateNaissance)
                ).format('yyyy-MM-DD');

              }
              if( this.rows[i].created_at !==''){
                   this.rows[i].created_at = moment(
                  String(this.rows[i].created_at)
                ).format('yyyy-MM-DD HH:mm:ss');
                this.rows[i].updated_at = moment(
                  String(this.rows[i].updated_at)
                ).format('yyyy-MM-DD HH:mm:ss');
                this.rows[i].deleted_at = moment(
                  String(this.rows[i].deleted_at)
                ).format('yyyy-MM-DD HH:mm:ss');
              }
            }
            // set All Races in Table
            // eslint-disable-next-line no-redeclare
            this.columns[3].filterOptions.filterDropdownItems = [];
            // eslint-disable-next-line no-redeclare
            for (var i = 0; i < this.rows.length; i++) {
              this.columns[3].filterOptions.filterDropdownItems.push(
                JSON.parse(JSON.stringify(this.rows[i].Race))
              );
              // this.FRaces = this.Races.filter((ele) => typeof (ele) !== 'object' ? ele : '')
            }
            this.isLoadiing = false;
          })
          .catch((err) => console.log(err));
      }
    },
    // Sort Function
    Sort(id) {
      this.selectedRowId = id;
      this.dialogFormSort = true;
    },
    // Activate Sujet
    ActivateSujet(id) {
      Axios.put('http://127.0.0.1:8000/api/ActivateSujet/' + id)
        .then((res) => {
          this.getSujets('', '');
          this.dialogFormVisible = false;
          this.$notify({
            title: 'Success',
            message: 'Sujet Activer',
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
    // Redirect(params) {
    //   if (params !== null  ) {
    //     this.$router.push({
    //       // path,
    //       name: 'mobile',
    //       // router.push({ name: 'user', params: { userId: '123' } })
    //       params: { id: params ,Type :"pdf" },
    //       /* query: {
    //         // t: +new Date(),
    //         // id: params,
    //       },*/
    //     });
    //   }
    //   },
    RedirectToShow(params, type) {
      if (params !== null && type !== '') {
        this.$router.push({
          // path,
          name: 'View',
          // router.push({ name: 'user', params: { userId: '123' } })
          params: { id: params, type: type },
          /* query: {
            // t: +new Date(),
            // id: params,
          },*/
        });
      } else {
        this.$router.push({
          path: '/View',
        });
      }
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

.international-icon {
  font-size: 20px;
  cursor: pointer;
  vertical-align: -5px !important;
}

.myFilter {
  transition: all 0.4 ease-in-out;
}
.myFilter:hover {
  background-color: #28c76f;
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
  display: inline-block;
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

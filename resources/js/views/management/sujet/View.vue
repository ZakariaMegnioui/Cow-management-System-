<template>
   <div class="container" style="padding: 0 3.2rem;">
    <!-- Sort Modal -->
    <!-- Modal -->
    <el-dialog title="Sort" :visible.sync="dialogFormSort">
      <el-form>
        <el-form-item label="Cause" :label-width="formLabelWidth">
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

        <el-form-item label="Info Cause" :label-width="formLabelWidth">
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
        <el-button type="danger" @click="Archive">Sort</el-button>
        <!-- End Button -->
      </span>
    </el-dialog>
    <div class="card formCard mt-6 mb-6">
      <!---->
      <!---->
      <div class="card-body">
        <!---->
        <!---->
        <form class="row" @submit.prevent="submitForm">
          <!-------------- Strat form ------------->
          <!-- first  -->
          <div
            class="col-xl-3 col-12 d-flex flex-column justify-content-between form-row"
          >
            <div class="mb-3">
              <label for="snit" class="fs-6 fw-normal mb-2">NSNIT</label>
              <input
                id="snit"
                v-model="sujet.NSNIT"
                type="text"
                :disabled="show === true"
                required
                class="form-control"
              >

            </div>
            <div class="mb-3">
              <label class="fs-6 fw-normal mb-2" for="ref">Reference</label>
              <input
                id="ref"
                v-model="sujet.NTravail"
                :disabled="show === true"
                type="text"
                class="form-control"
                required
              >
            </div>
            <div class="mb-3">
              <label
                for="date_nais"
                class="fs-6 fw-normal mb-2"
              >Date de naissance</label>
              <el-date-picker
                id="date_nais"
                v-model="sujet.DateNaissance"
                :disabled="show === true"
                type="datetime"
                placeholder="Date Naissance"
                required
              >
              <!--<input
                id="date_nais"
                v-model="sujet.DateNaissance"
                type="date"
                class="form-control"
              >-->
              </el-date-picker>
            </div>
            <div class="mb-3">
              <label
                for="proprietaire"
                class="fs-6 fw-normal mb-2"
              >Naisseur</label>
              <input
                id="naisseur"

                :type="sujet.naisseur.Nom ? 'text' : 'button'"
                :value="
                  sujet.proprietaire.Nom
                    ? `${sujet.proprietaire.Nom} ${sujet.proprietaire.Prenom}`
                    : 'Ajouter un Proprietaire'
                "
                class="form-control"
                :class="sujet.naisseur.Nom ? '' : 'btn btn-success '"

                @click="dialogFormNaisseur = true"
              >
            </div>
            <!-- Modal -->
            <el-dialog title="Naisseur" :visible.sync="dialogFormNaisseur" custom-class="dialog">
              <el-form :model="sujet.naisseur" :disabled="!openGenealogie">
                <el-form-item label :label-width="formLabelWidth">
                  <el-radio
                    v-model="NewNaisse"
                    :disabled="show == true || update == true"
                    label="1"
                    @change="clearN"
                  >Nauveau Naisseur</el-radio>
                  <el-radio
                    v-model="NewNaisse"
                    label="2"
                    @change="clearN"
                  >Exist Déja</el-radio>
                </el-form-item>
                <!--<el-form-item label="" :label-width="formLabelWidth">
                  <el-radio v-model="NewNaisse" :disabled="show == true || update == true" label="1" @change="clearN">New One</el-radio>
                  <el-radio v-model="NewNaisse" label="2" @change="clearN">Exist </el-radio>
                </el-form-item>-->
                <el-form-item label="CIN" :label-width="formLabelWidth">
                  <el-input
                    v-model="sujet.naisseur.CIN"
                    :disabled="show === true"
                    autocomplete="off"
                  />
                </el-form-item>
                <div class="w-full flex flex-row">
                  <el-form-item
                    label="Nom"
                    :label-width="formLabelWidth"
                    class="w-1/2"
                  >
                    <el-input
                      v-model="sujet.naisseur.Nom"
                      autocomplete="off"
                      :disabled="NewNaisse === '2'"
                    />
                  </el-form-item>

                  <el-form-item
                    label="Prenom"
                    :label-width="formLabelWidth"
                    class="w-1/2"
                  >
                    <el-input
                      v-model="sujet.naisseur.Prenom"
                      autocomplete="off"
                      :disabled="NewNaisse === '2'"
                    />
                  </el-form-item>
                </div>
                <el-form-item label="Adress" :label-width="formLabelWidth">
                  <el-input
                    v-model="sujet.naisseur.Adresse"
                    autocomplete="off"
                    :disabled="NewNaisse === '2'"
                  />
                </el-form-item>
                <el-form-item label :label-width="formLabelWidth">
                  <el-checkbox
                    v-if="NewNaisse === '1'"
                    v-model="checked"
                    @change="NaisseurIsProp"
                  >Proprietaire</el-checkbox>
                </el-form-item>
              </el-form>
              <!-- Start Button -->
              <span slot="footer" class="dialog-footer">
                <el-button
                  icon="el-icon-close"
                  @click="dialogFormNaisseur = false"
                >Cancel</el-button>
                <el-button
                  v-if="NewNaisse === '1'"
                  type="success"
                  icon="el-icon-check"
                  @click="createNaisseur"
                >Confirm </el-button>
                <el-button
                  v-else
                  type="success"
                  @click="ExNaiss"
                >Confirm </el-button>
                <!-- End Button -->
              </span>
            </el-dialog>
            <!-- naisseur ---------------------------- -->
            <!-- Modal -->
          </div>
          <!-- middel -->
          <div
            class="col-xl-3 col-12 d-flex flex-column justify-content-between"
          >
            <div class="mb-3 race">
              <label for="race" class="fs-6 fw-normal mb-2">Race</label>
              <el-autocomplete
                id="race"
                v-model="sujet.Race"
                class=""
                popper-class="my-autocomplete"
                :disabled="show === true"
                :fetch-suggestions="querySearch"
                required
              /></div>
            <div class="mb-3">
              <label for="sexe" class="fs-6 fw-normal mb-2">Sexe</label>
              <select
                id="sexe"
                v-model="sujet.Sexe"
                class="form-select"
                :disabled="show === true"
                aria-placeholder="select"
                required
              >

                <option selected disabled>Sexe</option>
                <option value="Female">Femelle</option>
                <option value="Male">Mâle</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="type" class="fs-6 fw-normal mb-2">Type</label>

              <select
                id="type"
                v-model="sujet.Type"
                required
                class="form-select"
                :disabled="show === true"
                aria-label="select type"
                aria-placeholder="select"
              >
                <option value="Vache">Vache</option>
                <option value="Veau">Veau</option>
              </select>
            </div>
            <div class="mb-3">

              <label
                for="proprietaire"
                class="fs-6 fw-normal mb-2"
              >Proprietaire</label>
              <input
                id="proprietaire"

                :type="sujet.proprietaire.Nom ? 'text' : 'button'"
                :value="
                  sujet.proprietaire.Nom
                    ? `${sujet.proprietaire.Nom} ${sujet.proprietaire.Prenom}`
                    : 'Ajouter un Proprietaire'
                "
                class="form-control"
                :class="sujet.proprietaire.Nom ? '' : 'btn btn-success '"
                @click="dialogFormProprietaire = true"
              >
            </div>
            <!-- Modal -->
            <el-dialog
              title="Proprietaire"
              :visible.sync="dialogFormProprietaire"
            >
              <el-form :model="sujet.proprietaire" :disabled="!openGenealogie">
                <el-form-item label :label-width="formLabelWidth">
                  <el-radio
                    v-model="Newproprietaire"
                    :disabled="show == true || update == true"
                    label="New"
                    @change="clearP"
                  >Nouveau Proprietaire
                  </el-radio>
                  <el-radio
                    v-model="Newproprietaire"
                    label="Exist"
                    @change="clearP"
                  >Exist Déja</el-radio>
                </el-form-item>

                <!-- ---------------------- -->
                <el-form-item label="CIN" :label-width="formLabelWidth">
                  <el-input
                    v-model="sujet.proprietaire.CIN"
                    :disabled="show === true"
                    autocomplete="off"
                  />
                </el-form-item>

                <div class="w-full flex flex-row">
                  <el-form-item
                    label="Nom"
                    class="w-1/2"
                    :label-width="formLabelWidth"
                  >
                    <el-input
                      v-model="sujet.proprietaire.Nom"
                      autocomplete="off"
                      :disabled="Newproprietaire === 'Exist'"
                    />
                  </el-form-item>

                  <el-form-item
                    label="Prenom"
                    class="w-1/2"
                    :label-width="formLabelWidth"
                  >
                    <el-input
                      v-model="sujet.proprietaire.Prenom"
                      autocomplete="off"
                      :disabled="Newproprietaire === 'Exist'"
                    />
                  </el-form-item>
                </div>

                <el-form-item label="Adress" :label-width="formLabelWidth">
                  <el-input
                    v-model="sujet.proprietaire.Adresse"
                    autocomplete="off"
                    :disabled="Newproprietaire === 'Exist'"
                  />
                </el-form-item>
              </el-form>
              <!-- Start Button -->
              <span slot="footer" class="dialog-footer">
                <el-button
                  icon="el-icon-close"
                  @click="dialogFormProprietaire =false"
                >Cancel</el-button>
                <el-button
                  v-if="Newproprietaire === 'New'"
                  type="success"
                  icon="el-icon-check"
                  @click="CreateProprietaire"
                >Confirm</el-button>
                <el-button
                  v-else
                  type="success"
                  @click="PropEx"
                >Confirm</el-button>
                <!-- End Button -->
              </span>
            </el-dialog>
            <!-- Proprie ---------------------------- -->
            <!-- Modal -->
          </div>
          <!-- last side -->
          <div
            class="col-xl-3 col-12 d-flex flex-column justify-content-between"
          >
            <div class="mb-3">
              <label for="region" class="fs-6 fw-normal mb-2">Region</label>
              <input
                id="region"
                v-model="sujet.Adresse"
                type="text"
                :disabled="show === true"
                class="form-control"
                required
              >
            </div>
            <div class="mb-3">
              <label for="dc" class="fs-6 fw-normal mb-2">Date Crétion</label>
              <input
                id="dc"
                type="text"
                class="form-control"
                disabled
                :value="sujet.dateCreation"
              >
            </div>
            <div class="mb-3">
              <label
                for="dm"
                class="fs-6 fw-normal mb-2"
              >Date Modifiaction</label>
              <input
                id="dm"
                type="text"
                class="form-control"
                disabled
                :value="sujet.dateModifiaction"
              >
            </div>
            <div class="mb-3">
              <label for="test" class="fs-6 fw-normal mb-2">Admin</label>
              <input
                id="test"
                v-model="sujet.admin"
                type="text"
                disabled
                class="form-control"
              >
            </div>
          </div>
          <!--------------- End form ---------------->
          <!--------------- Start QR code & Buutons ----------->
          <div
            class="
              align-items-center
              col-12 col-xl-3
              d-flex
              justify-content-between
              align-items-center
              qr-cod
            "
          >
            <div
              class="
                align-items-center
                d-flex
                flex-column
                justify-content-start
                w-full
              "
            >
              <span ref="qrCode" class="b-avatar-img block lg:mb-5 lg:p-7">
                <!-- <img
                    src="https://classetice.fr/v2/wp-content/uploads/2020/09/qr.jpg"
                alt="avatar" />-->
                <qr-code
                  :text="JSON.stringify(sujet.NTravail)"
                  error-level="L"
                  :size="288"
                />
              </span>

              <div class="d-flex flex-lg-column justify-center lg:mb-4 md:pt-0 pt-4 v w-100">

                <button

                 v-if="!show"

                  class="btn btn-primary w-3/5 md:w-full"
                  type="submit"
                >
                  {{ (!show && !update && !sujet.id )?'Valider': 'Modifier' }}
                </button>
                <button
                  v-if="
                    (show === true && sujet.Etat !== 'Sorte') ||
                      (update === true && sujet.Etat !== 'Sorte')
                  "
                  class="col btn btn-outline-danger mt-2"
                  @click="Sort"
                >
                  Sort
                </button>
              </div>
              <!-- src="https://classetice.fr/v2/wp-content/uploads/2020/09/qr.jpg" -->
            </div>
          </div>
          <!--------------- End QR code &Buttont ------------->
        </form>
        <!--end row-->
      </div>
      <!--card-body-->
    </div>

    <div class="card tabContainer mb-6">
      <!-- tabs #f8f8f8 -->
      <nav>
        <div id="nav-tab" class="nav nav-tabs" role="tablist">
          <button
            id="nav-home-tab"
            class="nav-link active"

            data-bs-toggle="tab"
            data-bs-target="#nav-home"
            type="button"
            role="tab"
            aria-controls="nav-home"
            aria-selected="true"
          >
            Genologique
          </button>
          <button
            id="nav-profile-tab"
            class="nav-link"
            :class="openIndex ? '' :'disabled' "
            data-bs-toggle="tab"
            data-bs-target="#nav-profile"
            type="button"
            role="tab"
            aria-controls="nav-profile"
            aria-selected="false"
          >
            Index
          </button>
          <button
            id="nav-contact-tab"
            class="nav-link"
            :class="openPerformonce ? '' : 'disabled'"
            data-bs-toggle="tab"
            data-bs-target="#nav-performonce"
            type="button"
            role="tab"
            aria-controls="nav-performonce"
            aria-selected="false"
          >
            Performonce
          </button>
          <button
            id="nav-photo-tab"


            class="nav-link"
            data-bs-toggle="tab"
            data-bs-target="#nav-contact"
            type="button"
            role="tab"
            aria-controls="nav-contact"
            aria-selected="false"
          >
            Photos
          </button>
        </div>
      </nav>
      <!-- nav -->
      <!-- tabsContent -->
      <div id="nav-tabContent" class="tab-content container-fluid">
        <!-- tab 1 start Geanlogie -->
        <!-- tab 1 start -->
        <div
          id="nav-home"
          class="tab-pane fade show active"
          role="tabpanel"
          aria-labelledby="nav-home-tab"
          :class="status ==='show' ? 'disable' : ''"
        >
          <div class="row m-2 mt-5">
            <!-- Start Col Pere -->
            <div class="col-xl-6 col-12 mb-5">
              <!--Start Card -->
              <div class="card h-100">
                <!--Pere-->
                <div class="card-header">Pere</div>
                <div class="card-body">
                  <el-form
                    label-position="left"
                    label-width="120px"
                    class="myForm h-full"
                    :model="sujet"
                  >
                    <el-form-item label="Numero">
                      <el-input
                        v-model="sujet.pere.N"
                        :disabled="sujet.pere.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Nom">
                      <el-input
                        v-model="sujet.pere.Nom"
                        :disabled="sujet.pere.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Date Naissance">
                      <el-date-picker
                        v-model="sujet.pere.Datenaissance"
                        type="date"
                        :disabled="sujet.pere.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Race">
                      <el-input
                        v-model="sujet.pere.Race"
                        :disabled="sujet.pere.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                  </el-form>
                  <el-row type="flex" class="gap-4" justify="end">
                    <el-col v-if="!sujet.peres_ID" :span="6">
                      <el-button
                        type="success"
                        icon="el-icon-check"
                        :disabled="!openGenealogie"

                        class="text-white"
                        @click="ValideButtonP"
                      >Valider</el-button>
                    </el-col>
                    <el-col v-else-if="sujet.peres_ID" :span="6">
                      <el-button
                        type="warning"
                        icon="el-icon-edit"
                        class="text-white"
                        @click="updateButtonP"
                      >Modifier</el-button>
                    </el-col>
                    <el-col :span="6">
                      <el-button
                        type="danger"
                        icon="el-icon-close"
                        :disabled="!openGenealogie"

                        class="text-white"
                        @click="annulleButtonP"
                      >Annuler</el-button>
                    </el-col>
                    <!-- <el-col :span="6">
                        <el-button type="warning" icon="el-icon-edit" round>Modifier</el-button>
                      </el-col>
                      <el-col :span="6">
                        <el-button type="danger" icon="el-icon-folder-delete" round plain>Archiver</el-button>
                    </el-col>-->
                  </el-row>
                </div>
              </div>
              <!--End Card -->
            </div>
            <!--End Col Pere -->

            <!-- Start Col Mere -->
            <div class="col-xl-6 col-12 mb-5">
              <!--Start Card -->
              <div class="card h-100">
                <div class="card-header">Mere</div>
                <div class="card-body">
                  <el-form
                    label-position="left"
                    label-width="120px"
                    class="myForm h-full"
                    :model="sujet"
                  >
                    <el-form-item label="Numero">
                      <el-input
                        v-model="sujet.mere.NSNIT"
                        :disabled="sujet.mere.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Date Naissance">
                      <el-date-picker
                        v-model="sujet.mere.DateNaissance"
                        type="date"
                        :disabled="sujet.mere.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Race">
                      <el-input
                        v-model="sujet.mere.Race"
                        :disabled="sujet.mere.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                  </el-form>
                  <el-row type="flex" class="gap-4" justify="end">
                    <el-col v-if="!sujet.meres_ID" :span="6">
                      <el-button
                        type="success"
                        icon="el-icon-check"
                        :disabled="!openGenealogie"

                        class="text-white"
                        @click="ValideButtonM"
                      >Valider</el-button>
                    </el-col>
                    <el-col v-else-if="sujet.meres_ID" :span="6">
                      <el-button
                        type="warning"
                        icon="el-icon-edit"
                        class="text-white"
                        @click="updateButtonM"
                      >Modifier</el-button>
                    </el-col>
                    <el-col :span="6">
                      <el-button
                        type="danger"
                        icon="el-icon-close"


                        class="text-white"
                        @click="annulleButtonM"
                      >Annuler</el-button>
                    </el-col>
                  </el-row>
                </div>
              </div>
              <!--End Card -->
            </div>
            <!--End Col Mere -->

            <!-- Start Col GMP -->
            <div class="col-xl-6 col-12 mb-5">
              <!--Start Card -->
              <div class="card h-100">
                <div class="card-header">Grand Mere Paternell</div>
                <div class="card-body">
                  <el-form
                    label-position="left"
                    label-width="120px"
                    class="myForm h-full"
                    :model="sujet"
                  >
                    <el-form-item label="Numero">
                      <el-input
                        v-model="sujet.grandMerePaternell.N"
                        :disabled="sujet.grandMerePaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Date Naissance">
                      <el-date-picker
                        v-model="sujet.grandMerePaternell.DateNaissance"
                        type="date"
                        :disabled="sujet.grandMerePaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Race">
                      <el-input
                        v-model="sujet.grandMerePaternell.Race"
                        :disabled="sujet.grandMerePaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                  </el-form>
                  <el-row type="flex" class="gap-4" justify="end">
                    <el-col
                      v-if="!sujet.GrandMerePaternelles_ID"
                      :span="6"
                    >
                      <el-button
                        type="success"
                        icon="el-icon-check"
                        :disabled="!openGenealogie"

                        class="text-white"
                        @click="ValideButtonGMP"
                      >Valider</el-button>
                    </el-col>
                    <el-col
                      v-else-if="sujet.GrandMerePaternelles_ID
                    "
                      :span="6"
                    >
                      <el-button
                        type="warning"
                        icon="el-icon-edit"
                        class="text-white"
                        @click="updateButtonGMP"
                      >Modifier</el-button>
                    </el-col>
                    <el-col :span="6">
                      <el-button
                        type="danger"
                        icon="el-icon-close"

                        :disabled="!openGenealogie"
                        class="text-white"
                        @click="annulleButtonGMP"
                      >Annuler</el-button>
                    </el-col>
                  </el-row>
                </div>
              </div>
              <!--End Card -->
            </div>
            <!--End Col GMP -->

            <!-- Start Col GMM -->
            <div class="col-xl-6 col-12 mb-5">
              <!--Start Card -->
              <div class="card h-100">
                <div class="card-header">Grand Mere Maternell</div>
                <div class="card-body">
                  <el-form
                    label-position="left"
                    label-width="120px"
                    class="myForm h-full"
                    :model="sujet"
                  >
                    <el-form-item label="Numero">
                      <el-input
                        v-model="sujet.grandMereMaternell.NSNIT"
                        :disabled="sujet.grandMereMaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Date Naissance">
                      <el-date-picker
                        v-model="sujet.grandMereMaternell.DateNaissance"
                        type="date"
                        :disabled="sujet.grandMereMaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Race">
                      <el-input
                        v-model="sujet.grandMereMaternell.Race"
                        :disabled="sujet.grandMereMaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                  </el-form>
                  <el-row type="flex" class="gap-4" justify="end">
                    <el-col
                      v-if="!sujet.GrandMereMaternelles_ID"
                      :span="6"
                    >
                      <el-button
                        type="success"
                        icon="el-icon-check"

                        :disabled="!openGenealogie"
                        class="text-white"
                        @click="ValideButtonGMM"
                      >Valider</el-button>
                    </el-col>
                    <el-col
                      v-else-if="sujet.GrandMereMaternelles_ID"
                      :span="6"
                    >
                      <el-button
                        type="warning"
                        icon="el-icon-edit"
                        class="text-white"
                        @click="updateButtonGMM"
                      >Modifier</el-button>
                    </el-col>
                    <el-col :span="6">
                      <el-button
                        type="danger"
                        icon="el-icon-close"
                        class="text-white"
                        :disabled="!openGenealogie"
                        @click="annulleButtonGMM"
                      >Annuler</el-button>
                    </el-col>
                  </el-row>
                </div>
              </div>
              <!--End Card -->
            </div>
            <!--End Col GMM -->

            <!-- Start Col GPP -->
            <div class="col-xl-6 col-12 mb-5">
              <!--Start Card -->
              <div class="card">
                <div class="card-header">Grand Pere Paternell</div>
                <div class="card-body">
                  <el-form
                    label-position="left"
                    label-width="120px"
                    class="myForm h-full"
                    :model="sujet"
                  >
                    <el-form-item label="Numero">
                      <el-input
                        v-model="sujet.grandPerePaternell.N"
                        :disabled="sujet.grandPerePaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Nom">
                      <el-input
                        v-model="sujet.grandPerePaternell.Nom"
                        :disabled="sujet.grandPerePaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Date Naissance">
                      <el-date-picker
                        v-model="sujet.grandPerePaternell.DateNaissance"
                        type="date"
                        :disabled="sujet.grandPerePaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Race">
                      <el-input
                        v-model="sujet.grandPerePaternell.Race"
                        :disabled="sujet.grandPerePaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                  </el-form>
                  <el-row type="flex" class="gap-4" justify="end">
                    <el-col
                      v-if="!sujet.GrandPerePaternels_ID"
                      :span="6"
                    >
                      <el-button
                        type="success"
                        icon="el-icon-check"
                        :disabled="!openGenealogie"

                        class="text-white"
                        @click="ValideButtonGPP"
                      >Valider</el-button>
                    </el-col>
                    <el-col
                      v-else-if="sujet.GrandPerePaternels_ID"
                      :span="6"
                    >
                      <el-button
                        type="warning"
                        icon="el-icon-edit"
                        class="text-white"
                        @click="updateButtonGPP"
                      >Modifier</el-button>
                    </el-col>
                    <el-col :span="6">
                      <el-button
                        type="danger"
                        icon="el-icon-close"

                        :disabled="!openGenealogie"
                        class="text-white"
                        @click="annulleButtonGPP"
                      >Annuler</el-button>
                    </el-col>
                  </el-row>
                </div>
              </div>
              <!--End Card -->
            </div>
            <!--End Col GPP -->

            <!-- Start Col GPM -->
            <div class="col-xl-6 col-12 mb-5">
              <!--Start Card -->
              <div class="card">
                <div class="card-header">Grand Pere Maternell</div>
                <div class="card-body">
                  <el-form
                    label-position="left"
                    label-width="120px"
                    class="myForm h-full"
                    :model="sujet"
                  >
                    <el-form-item label="Numero">
                      <el-input
                        v-model="sujet.grandPereMaternell.N"
                        :disabled="sujet.grandPereMaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Nom">
                      <el-input
                        v-model="sujet.grandPereMaternell.Nom"
                        :disabled="sujet.grandPereMaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Date Naissance">
                      <el-date-picker
                        v-model="sujet.grandPereMaternell.DateNaissance"
                        type="date"
                        :disabled="sujet.grandPereMaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                    <el-form-item label="Race">
                      <el-input
                        v-model="sujet.grandPereMaternell.Race"
                        :disabled="sujet.grandPereMaternell.remp === true || !openGenealogie"
                      />
                    </el-form-item>
                  </el-form>
                  <el-row type="flex" class="gap-4" justify="end">
                    <el-col
                      v-if="!sujet.GrandPereMaternels_ID"
                      :span="6"
                    >
                      <el-button
                        type="success"
                        icon="el-icon-check"
                        class="text-white"
                        :disabled="!openGenealogie"
                        @click="ValideButtonGPM"
                      >Valider</el-button>
                    </el-col>
                    <el-col
                      v-else-if="sujet.GrandPereMaternels_ID"
                      :span="6"
                    >
                      <el-button
                        :disabled="!openGenealogie"

                        type="warning"
                        icon="el-icon-edit"
                        class="text-white"
                        @click="updateButtonGPM"
                      >Modifier</el-button>
                    </el-col>
                    <el-col :span="6">
                      <el-button
                        type="danger"
                        icon="el-icon-close"

                        :disabled="!openGenealogie"
                        class="text-white"
                        @click="annulleButtonGPM"
                      >Annuler</el-button>
                    </el-col>
                  </el-row>
                </div>
              </div>
              <!--End Card -->
            </div>
            <!--End Col GPM -->
          </div>
          <!--End row-->
        </div>
        <!-- tab 1 end -->

        <!-- tab 2  start Index -->
        <div
          id="nav-profile"
          class="tab-pane fade rounded"
          role="tabpanel"
          aria-labelledby="nav-profile-tab"
        >
          <SujetIndex :pdf="pdf" :sujet="sujet" :status="status" />
        </div>
        <!-- tab 2 end -->
        <!-- tab 3 start -->
        <div
          id="nav-performonce"
          class="tab-pane fade mb-5 mt-5"
          role="tabpanel"
          aria-labelledby="nav-profile-tab"
        >
          <!-- @getperformoncesujetdata="getperformoncesujetdata" @getperformonceGMerMaterneldata="getperformonceGMerMaterneldata" @getperformonceMeredata="getperformonceMeredata" -->
          <Performonce
            v-if="sujet.meres_ID || sujet.GrandMereMaternelles_ID || sujet.id"
            :pdf="pdf"
            :sujet="sujet"
            :status="status"
          />
        </div>
        <!-- tab 3 end -->

        <!-- tab 4 start -->
        <div
          id="nav-contact"
          class="tab-pane fade"
          role="tabpanel"
          aria-labelledby="nav-contact-tab"
        >
          <Photo :status="status" :sujet="sujet" />
        </div>
        <!-- tab 4 3nd  -->
      </div>
      <!-- /tabbable -->
    </div>
  </div>
  <!--card-->
  <!---->
  <!---->
  <!--  -->
</template>
<script>
// import VueQr from '/vue-qr'
import VueQRCodeComponent from 'vue-qrcode-component';
// import Axios
import Axios from 'axios';
import moment from 'moment';
import SujetIndex from './SujetIndex';
import Performonce from './Performonce';
import Photo from './Photo';

export default {
  name: 'CowCard',
  components: {
    'qr-code': VueQRCodeComponent,
    SujetIndex,
    Performonce,
    Photo,
  },
  props: { genealogie: { type: Array, default: null, require: true }},
  data() {
    return {
      pdf: {},
      status: 'add',
      openGenealogie: false,
      tabIndex: 1,
      openPerformonce: false,
      openIndex: false,
      links: [],
      myUrl: [],
      cowDialogImageUrl: '',
      cowDialogVisible: false,
      dialogFormNaisseur: false,
      dialogFormProprietaire: false,
      sujet: {
        id: null,
        NTravail: '',
        NSNIT: '',
        DateNaissance: new Date(),
        Race: '',
        Sexe: '',
        Type: '',
        image1: '',
        image2: '',
        meres_ID: '',
        peres_ID: '',
        GrandPerePaternels_ID: '',
        GrandPereMaternels_ID: '',
        GrandMerePaternelles_ID: '',
        GrandMereMaternelles_ID: '',
        EleveurProprietaires_ID: '',
        EleveurNaisseurs_ID: '',
        Adresse: '',
        dateCreation: new Date().toDateString(),
        dateModifiaction: new Date().toDateString(),
        admin: '',
        // Prop
        proprietaire: {
          id: null,
          CIN: '',
          Nom: '',
          Prenom: '',
          Adresse: '',
          sreach: false,
        },
        // Naisseur
        naisseur: {
          id: null,
          CIN: '',
          Nom: '',
          Prenom: '',
          Adresse: '',
          sreach: false,
        },
        // genalogie
        // -------- Pere ---------
        pere: {
          // pére
          id: null,
          N: null,
          Nom: '',
          Datenaissance: new Date(),
          Race: '',
          remp: false,
        },
        grandMerePaternell: {
          // grand mere peternell (GMP)
          id: null,
          N: null,
          DateNaissance: new Date(),
          Race: '',
          remp: false,
        },
        grandPerePaternell: {
          // grand pere peternell (GPP)
          id: null,
          N: null,
          Nom: '',
          DateNaissance: new Date(),
          Race: '',
          remp: false,
        },
        // ----------- Mere ---------
        mere: {
          // mére
          id: null,
          NSNIT: null,
          DateNaissance: new Date(),
          Race: '',
          remp: false,
        },
        grandMereMaternell: {
          // grand mere maternell (GMM)
          id: null,
          NSNIT: null,
          DateNaissance: new Date(),
          Race: '',
          remp: false,
        },
        grandPereMaternell: {
          // grand pere maternell (GPM)
          N: null,
          Nom: '',
          DateNaissance: new Date(),
          Race: '',
          remp: false,
        },
      },
      show: false,
      update: false,
      Newproprietaire: 'New',
      checked: false,
      NewNaisse: '1',
      //  Sort Dialog
      dialogFormSort: false,
      SortCaus: [
        {
          value: 'Mort',
          label: 'Mort',
        },
        {
          value: 'Sort',
          label: 'Sort',
        },
        {
          value: 'Cause3',
          label: 'Cause3',
        },
      ],
      sortData: {
        SortValue: '',
        infoCause: '',
      },
      dialogImageUrl: '',
      dialogVisible: false,
      disabled: false,
      formLabelWidth: '120px',
    };
  },
  watch: {
    sujet: function(value) {
      console.log(value);
    },
  },
  mounted() {
    this.links = this.loadAll();
    if (this.$route.params.id) {
      this.showUpdateData();
    } else {
      this.status = 'add';
      this.openGenealogie = false;
      this.openPerformonce = false;
      this.openIndex = false;
    }
  },
  methods: {
    // Index event

    AddPic(file) {
      const url = URL.createObjectURL(file.target.files[0]);
      this.myUrl.push(url);
      // console.log(file)
      // console.log(file.target)
      // console.log(file.target.files[0])
      this.sujet.Image1 = file.target.files[0];
      console.log(this.myUrl);
      console.log(this.sujet.Image1);
    },
    onSuccess(file) {
      console.log('Start onSuccess');
      this.cowDialogImageUrl = file.url;
      this.cowDialogVisible = true;
      console.log(file);
      console.log('End onSuccess');
    },

    querySearch(queryString, cb) {
      var links = this.links;
      var results = queryString
        ? links.filter(this.createFilter(queryString))
        : links;
      // call callback function to return suggestions
      cb(results);
    },
    createFilter(queryString) {
      return (link) => {
        return (
          link.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0
        );
      };
    },
    loadAll() {
      return [{ value: 'HOLSTEIN' }, { value: 'Hereford cattle' }, {
        value: 'Normande',
      }, {
        value: 'Limousin',
      }, {
        value: 'Armoricaine',
      }, {
        value: 'Pie Rouge des Plaine',
      }];
    },
    handleSelect(item) {
      // console.log(item);
    },
    // ------------------------------
    handleRemove(file) {
      // console.log(file);
    },
    handlePictureCardPreview(file) {
      this.dialogImageUrl = file.url;
      this.dialogVisible = true;
    },
    handleDownload(file) {
      // console.log(file);
    },
    // *********************** Creation dProdution *************************/

    // ********************* Creation Functions ******************************/
    // create Data function submit sujet form
    submitForm() {
      if (!this.sujet.id){
        this.createSujet();
      } else {
        this.UpdateSujet();
      }
    },
    // create new Proprietaire
    CreateProprietaire() {
      if (this.Newproprietaire === 'New') {
        this.sujet.proprietaire.sreach = false;
        const PropData = Object.assign({}, this.sujet.proprietaire);
        if (PropData.CIN !== '') {
          Axios.post('http://127.0.0.1:8000/api/Eleveurproprietaire/', PropData)
            .then((res) => {
              const msg = res.data.Msg;
              if (msg !== undefined) {
                this.sujet.EleveurProprietaires_ID = res.data.id;

                this.errNotify(
                  'Il y à une Proprietaire avec ce numéro CIN Dans la base de donnee.'
                );
              } else {
                this.sujet.EleveurProprietaires_ID = res.data.data.id;
                this.sujet.eleveurproprietaire = res.data.data;
                this.$notify({
                  title: 'Success',
                  message: 'Proprietaire Bien Ajoutee',
                  type: 'success',
                  duration: 2000,
                });
              }
              this.UpdateSujet('msg');
            })
            // eslint-disable-next-line handle-callback-err
            .catch((err) => {
              this.errNotify(err);
            });
        }
      } else if (this.Newproprietaire === 'Exist') {
        this.PropEx();
        this.UpdateSujet('msg');
      }
      this.dialogFormProprietaire = false;
    },
    // Create new Sujet
    createSujet() {
      const tempData = Object.assign({}, this.sujet);
      Axios.post('/api/Sujet/', tempData)
        .then((res) => {
          const msg = res.data.Msg;
          if (msg !== undefined) {
            this.errNotify(
              'Il y à une sujet avec ce Reference Dans la base de donnee.'
            );
          } else {
            this.$notify({
              title: 'Success',
              message: 'Sujet Bien Ajoutee',
              type: 'success',
              duration: 2000,
            });
            this.openGenealogie = true;
            this.sujet.id = res.data.data.id;
            this.sujet.mere.remp = true;
            this.getIndexValues(this.sujet.id);
          }
        })
        .catch((err) => {
          this.errNotify(err);
        });
    },
    // create new Naisseur
    createNaisseur() {
      if (this.NewNaisse === '1') {
        this.sujet.naisseur.sreach = false;
        const NaissData = Object.assign({}, this.sujet.naisseur);
        if (NaissData.CIN !== '') {
          Axios.post('http://127.0.0.1:8000/api/Eleveursnaisseurs/', NaissData)
            .then((res) => {
              const msg = res.data.Msg;
              if (msg !== undefined) {
                this.sujet.EleveurNaisseurs_ID = res.data.id;
                this.errNotify(
                  'Il y à un Naisseur avec ce numéro CIN Dans la base de donnee.'
                );
              } else {
                this.sujet.EleveurNaisseurs_ID = res.data.data.id;

                this.$notify({
                  title: 'Success',
                  message: 'Naisseur Bien Ajoutee',
                  type: 'success',
                  duration: 2000,
                });
              }
            })
            // eslint-disable-next-line handle-callback-err
            .catch((err) => {
              this.errNotify(err);
            });
        }
      } else if (this.NewNaisse === '2') {
        this.ExNaiss();
      }
      this.dialogFormNaisseur = false;
    },

    // Create Pere
    createPere() {
      const PereData = Object.assign({}, this.sujet.pere);

      if (PereData.N !== null) {
        if (this.older(PereData.Datenaissance, this.sujet.DateNaissance)){
          Axios.post('http://127.0.0.1:8000/api/Peres/', PereData)
            .then((res) => {
              const msg = res.data.Msg;
              if (msg !== undefined) {
                this.sujet.peres_ID = res.data.Pere.id;
                this.sujet.pere.id = res.data.Pere.id;
                this.sujet.pere.N = res.data.Pere.N;
                this.sujet.pere.Nom = res.data.Pere.Nom;
                if (this.sujet.pere.Datenaissance !== null) {
                  this.sujet.pere.Datenaissance = moment(
                    String(res.data.Pere.Datenaissance)
                  ).format('yyyy-MM-DD HH:mm:ss');
                }
                this.sujet.pere.remp = true;
                this.sujet.pere.Race = res.data.Pere.Race;
                this.$notify({
                  title: 'info',
                  message:
                  'Il y à une Pere avec ce numéro  Dans la base de donnee.',
                  type: 'info',
                  duration: 2000,
                });
              } else {
                this.sujet.peres_ID = res.data.data.id;
                this.sujet.pere.id = res.data.data.id;
                this.$notify({
                  title: 'Success',
                  message: 'Pere Bien Ajoutee',
                  type: 'success',
                  duration: 2000,
                });
              }
              this.UpdateSujet('msg');
              this.getIndexValues(this.sujet.id);
              this.openIndex = true;
              this.sujet.pere.remp = true;
            })
          // eslint-disable-next-line handle-callback-err
            .catch((err) => {
              this.errNotify(err);
            });
        } else {
          this.$notify({
            title: 'Info',
            message: "l'âge de l'enfant est supérieur à l'âge des parents",
            type: 'info',
            duration: 2000,
          });
        }
      }
    },
    getIndexValues(id) {
      Axios.get(`/api/PdfData/${id}/update`)
        .then((res) => {
          this.pdf = res.data.Pdf;
        })

        .catch((err) => {
          this.errNotify(err);
        });
    },
    // create Mere
    createMere() {
      const MereData = Object.assign({}, this.sujet.mere);
      if (MereData.NSNIT !== null) {
        if (this.older(MereData.DateNaissance, this.sujet.DateNaissance)){
          Axios.post('http://127.0.0.1:8000/api/Meres/', MereData)
            .then((res) => {
              const msg = res.data.Msg;
              if (msg !== undefined) {
                console.log(res.data.Mere);
                this.sujet.meres_ID = res.data.Mere.id;
                this.sujet.mere.NSNIT = res.data.Mere.NSNIT;
                this.sujet.mere.Race = res.data.Mere.Race;
                if (this.sujet.mere.Datenaissance !== null) {
                  this.sujet.mere.Datenaissance = moment(
                    String(res.data.Mere.Datenaissance)
                  ).format('yyyy-MM-DD HH:mm:ss');
                }
                this.sujet.mere.remp = true;
                this.$notify({
                  title: 'info',
                  message:
                  'Il y à une Mere avec ce numéro  Dans la base de donnee.',
                  type: 'info',
                  duration: 2000,
                });
              } else {
                this.sujet.meres_ID = res.data.data.id;
                console.log(res.data.data.id);
                this.$notify({
                  title: 'Success',
                  message: 'Mere Bien Ajoutee',
                  type: 'success',
                  duration: 2000,
                });
              }
              this.UpdateSujet('msg');
              this.openPerformonce = true;
              this.sujet.mere.remp = true;
            })
          // eslint-disable-next-line handle-callback-err
            .catch((err) => {
              this.errNotify(err);
            });
        } else {
          this.$notify({
            title: 'Info',
            message: "l'âge de l'enfant est supérieur à l'âge des parents",
            type: 'info',
            duration: 2000,
          });
        }
      }
    },
    // Create Grand mere paternelles
    createGMP() {
      const PGMPData = Object.assign({}, this.sujet.grandMerePaternell);
      if (PGMPData.N !== null) {
        if (this.older(PGMPData.DateNaissance, this.sujet.DateNaissance)){
          Axios.post('http://127.0.0.1:8000/api/Grandmerepaternelles/', PGMPData)
            .then((res) => {
              const msg = res.data.Msg;
              if (msg !== undefined) {
                this.sujet.GrandMerePaternelles_ID =
                res.data.Grandmerepaternelle.id;
                this.sujet.grandMerePaternell.N = res.data.Grandmerepaternelle.N;
                if (this.sujet.grandMerePaternell.Datenaissance !== null) {
                  this.sujet.grandMerePaternell.DateNaissance = moment(
                    String(res.data.Grandmerepaternelle.DateNaissance)
                  ).format('yyyy-MM-DD HH:mm:ss');
                }
                this.sujet.grandMerePaternell.remp = true;
                this.sujet.grandMerePaternell.Race =
                res.data.Grandmerepaternelle.Race;
                this.$notify({
                  title: 'info',
                  message:
                  'Il y à une Grandmerepaternelle avec ce numéro  Dans la base de donnee.',
                  type: 'info',
                  duration: 2000,
                });
              } else {
                this.sujet.GrandMerePaternelles_ID = res.data.data.id;
                this.$notify({
                  title: 'Success',
                  message: 'Grandmerepaternelle Bien Ajoutee',
                  type: 'success',
                  duration: 2000,
                });
              }
              this.UpdateSujet('msg');
              this.sujet.grandMerePaternell.remp = true;
            })
          // eslint-disable-next-line handle-callback-err
            .catch((err) => {
              this.errNotify(err);
            });
        } else {
          this.$notify({
            title: 'Info',
            message: "l'âge de l'enfant est supérieur à l'âge des parents",
            type: 'info',
            duration: 2000,
          });
        }
      }
    },
    // Create GMereMatternilles
    createGMM() {
      const PGMMData = Object.assign({}, this.sujet.grandMereMaternell);
      if (PGMMData.NSNIT !== null) {
        if (this.older(PGMMData.DateNaissance, this.sujet.DateNaissance)){
          Axios.post('http://127.0.0.1:8000/api/Grandmerematernelles/', PGMMData)
            .then((res) => {
              const msg = res.data.Msg;
              if (msg !== undefined) {
                this.sujet.GrandMereMaternelles_ID =
                res.data.Grandmerematernelle.id;
                this.sujet.grandMereMaternell.NSNIT =
                this.sujet.grandMereMaternell.id =
                  res.data.Grandmerematernelle.id;
                res.data.Grandmerematernelle.NSNIT;
                if (this.sujet.grandMereMaternell.Datenaissance !== null) {
                  this.sujet.grandMereMaternell.DateNaissance = moment(
                    String(res.data.Grandmerematernelle.DateNaissance)
                  ).format('yyyy-MM-DD HH:mm:ss');
                }
                this.sujet.grandMereMaternell.remp = true;
                this.sujet.grandMereMaternell.Race =
                res.data.Grandmerematernelle.Race;
                this.$notify({
                  title: 'info',
                  message:
                  'Il y à une grandMereMaternell avec ce numéro  Dans la base de donnee.',
                  type: 'info',
                  duration: 2000,
                });
              } else {
                this.sujet.GrandMereMaternelles_ID = res.data.data.id;
                this.$notify({
                  title: 'Success',
                  message: 'grandMereMaternell Bien Ajoutee',
                  type: 'success',
                  duration: 2000,
                });
              }
              this.UpdateSujet('msg');
              this.sujet.grandMereMaternell.remp = true;
            })
          // eslint-disable-next-line handle-callback-err
            .catch((err) => {
              this.errNotify(err);
            });
        } else {
          this.$notify({
            title: 'Info',
            message: "l'âge de l'enfant est supérieur à l'âge des parents",
            type: 'info',
            duration: 2000,
          });
        }
      }
    },
    // create grandPereMaternell
    createGPM() {
      const GPMData = Object.assign({}, this.sujet.grandPereMaternell);
      if (GPMData.N !== null) {
        if (this.older(GPMData.DateNaissance, this.sujet.DateNaissance)){
          Axios.post('http://127.0.0.1:8000/api/Grandperematernels/', GPMData)
            .then((res) => {
              const msg = res.data.Msg;
              if (msg !== undefined) {
                this.sujet.GrandPereMaternels_ID = res.data.Grandperematernel.id;
                this.sujet.grandPereMaternell.N = res.data.Grandperematernel.N;
                this.sujet.grandPereMaternell.Nom =
                res.data.Grandperematernel.Nom;
                if (this.sujet.grandPereMaternell.Datenaissance !== null) {
                  this.sujet.grandPereMaternell.Datenaissance = moment(
                    String(res.data.Grandperematernel.Datenaissance)
                  ).format('yyyy-MM-DD HH:mm:ss');
                }
                this.sujet.grandPereMaternell.remp = true;
                this.sujet.grandPereMaternell.Race =
                res.data.Grandperematernel.Race;
                this.$notify({
                  title: 'info',
                  message:
                  'Il y à une Grandperematernel avec ce numéro  Dans la base de donnee.',
                  type: 'info',
                  duration: 2000,
                });
              } else {
                this.sujet.GrandPereMaternels_ID = res.data.data.id;
                console.log(res.data.data.N);
                this.$notify({
                  title: 'Success',
                  message: 'grandPereMaternell Bien Ajoutee',
                  type: 'success',
                  duration: 2000,
                });
              }
              this.UpdateSujet('msg');
            })
          // eslint-disable-next-line handle-callback-err
            .catch((err) => {
              this.errNotify(err);
            });
        } else {
          this.$notify({
            title: 'Info',
            message: "l'âge de l'enfant est supérieur à l'âge des parents",
            type: 'info',
            duration: 2000,
          });
        }
      }
    },
    // Create Grand PerePaternell
    createGPP() {
      const GPPData = Object.assign({}, this.sujet.grandPerePaternell);
      if (GPPData.N !== null) {
        if (this.older(GPPData.DateNaissance, this.sujet.DateNaissance)){
          Axios.post('http://127.0.0.1:8000/api/Grandperepaternels/', GPPData)
            .then((res) => {
              const msg = res.data.Msg;
              if (msg !== undefined) {
                this.sujet.GrandPerePaternels_ID = res.data.Grandperepaternel.id;
                this.sujet.grandPerePaternell.N = res.data.Grandperepaternel.N;
                this.sujet.grandPerePaternell.Nom =
                res.data.Grandperepaternel.Nom;
                if (this.sujet.grandPerePaternell.Datenaissance !== null) {
                  this.sujet.grandPerePaternell.Datenaissance = moment(
                    String(res.data.Grandperepaternel.Datenaissance)
                  ).format('yyyy-MM-DD HH:mm:ss');
                }
                this.sujet.grandPerePaternell.remp = true;
                this.sujet.grandPerePaternell.Race =
                res.data.Grandperepaternel.Race;
                this.$notify({
                  title: 'info',
                  message:
                  'Il y à une grandPerePaternell avec ce numéro  Dans la base de donnee.',
                  type: 'info',
                  duration: 2000,
                });

                this.sujet.grandPerePaternell.remp = true;
              } else {
                this.sujet.GrandPerePaternels_ID = res.data.data.id;

                this.$notify({
                  title: 'Success',
                  message: 'grandPerePaternell Bien Ajoutee',
                  type: 'success',
                  duration: 2000,
                });
              }
              this.UpdateSujet('msg');
            })
          // eslint-disable-next-line handle-callback-err
            .catch((err) => {
              this.errNotify(err);
            });
        } else {
          this.$notify({
            title: 'Info',
            message: "l'âge de l'enfant est supérieur à l'âge des parents",
            type: 'info',
            duration: 2000,
          });
        }
      }
    },

    /* ************* Buttons Valider Modifier Anuller dyal forms ************/
    // Start Pere Form
    ValideButtonP() {
      this.createPere();
    },
    updateButtonP() {
      this.sujet.pere.remp = false;
    },
    annulleButtonP() {
      this.sujet.peres_ID = '';
      this.sujet.pere.N = null;
      this.sujet.pere.Nom = '';
      this.sujet.pere.Race = '';
      this.sujet.pere.Datenaissance = new Date();
      this.sujet.pere.remp = false;
    },
    // End Pere Form
    // Start grandMerePaternell form
    ValideButtonGMP() {
      this.createGMP();
    },
    updateButtonGMP() {
      this.sujet.grandMerePaternell.remp = false;
    },
    annulleButtonGMP() {
      this.sujet.GrandMerePaternelles_ID = '';
      this.sujet.grandMerePaternell.N = null;
      this.sujet.grandMerePaternell.Race = '';
      this.sujet.grandMerePaternell.DateNaissance = new Date();
      this.sujet.grandMerePaternell.remp = false;
    },
    // update and valid and anuller Button grandMereMaternell function
    ValideButtonGMM() {
      this.createGMM();
    },
    updateButtonGMM() {
      this.sujet.grandMereMaternell.remp = false;
    },
    annulleButtonGMM() {
      this.sujet.GrandMereMaternelles_ID = '';
      this.sujet.grandMereMaternell.NSNIT = null;
      this.sujet.grandMereMaternell.Race = '';
      this.sujet.grandMereMaternell.DateNaissance = new Date();
      this.sujet.grandMereMaternell.remp = false;
    },
    // update and valid and anuller Button grandPereMaternell function
    ValideButtonGPM() {
      this.createGPM();
      this.sujet.grandPereMaternell.remp = true;
    },
    updateButtonGPM() {
      this.sujet.grandPereMaternell.remp = false;
    },
    annulleButtonGPM() {
      this.sujet.GrandPereMaternels_ID = '';
      this.sujet.grandPereMaternell.N = null;
      this.sujet.grandPereMaternell.Race = '';
      this.sujet.grandPereMaternell.Nom = '';
      this.sujet.grandPereMaternell.DateNaissance = new Date();
      this.sujet.grandPereMaternell.remp = false;
    },
    // update and valid and anuller Button grandPerePaternell function
    ValideButtonGPP() {
      this.createGPP();
    },
    updateButtonGPP() {
      this.sujet.grandPerePaternell.remp = false;
    },
    annulleButtonGPP() {
      this.sujet.GrandPerePaternels_ID = '';
      this.sujet.grandPerePaternell.N = null;
      this.sujet.grandPerePaternell.Race = '';
      this.sujet.grandPerePaternell.Nom = '';
      this.sujet.grandPerePaternell.DateNaissance = new Date();
      this.sujet.grandPerePaternell.remp = false;
    },
    // update and valid and anuller Button Mere function
    ValideButtonM() {
      this.createMere();
    },
    updateButtonM() {
      this.sujet.mere.remp = false;
    },
    annulleButtonM() {
      this.sujet.peres_ID = '';
      this.sujet.mere.NSNIT = null;
      this.sujet.mere.Race = '';
      this.sujet.mere.Datenaissance = new Date();
      this.sujet.mere.remp = false;
    },
    // #####################################################
    // if Propraitair Exist
    PropEx() {
      this.sujet.proprietaire.sreach = true;
      const PropData = Object.assign({}, this.sujet.proprietaire);
      if (PropData.CIN !== '') {
        Axios.post('http://127.0.0.1:8000/api/Eleveurproprietaire/', PropData)
          .then((res) => {
            if (res.data.Msg !== undefined) {
              this.$notify({
                title: 'Success',
                message: res.data.Msg,
                type: 'success',
                duration: 2000,
              });
              this.sujet.EleveurProprietaires_ID = res.data.id;
              this.sujet.proprietaire.id = res.data.id;
              this.sujet.proprietaire.CIN = res.data.Propr.CIN;
              this.sujet.proprietaire.Nom = res.data.Propr.Nom;
              this.sujet.proprietaire.Prenom = res.data.Propr.Prenom;
              this.sujet.proprietaire.Adresse = res.data.Propr.Adresse;
              this.dialogFormProprietaire = false;
            } else {
              this.errNotify(res.data.message);
            }
          })
          // eslint-disable-next-line handle-callback-err
          .catch((err) => {
            this.errNotify(err);
          });
      }
    },
    // Naisseur Exist
    // if Naisseur Exist
    ExNaiss() {
      if (this.NewNaisse === '2') {
        this.sujet.naisseur.sreach = true;
        const NaissData = Object.assign({}, this.sujet.naisseur);
        // console.log(NaissData);
        Axios.post('http://127.0.0.1:8000/api/Eleveursnaisseurs/', NaissData)
          .then((res) => {
            if (res.data.Msg !== undefined) {
              this.$notify({
                title: 'Success',
                message: res.data.Msg,
                type: 'success',
                duration: 2000,
              });
              this.sujet.EleveurNaisseurs_ID = res.data.id;
              this.sujet.naisseur.CIN = res.data.Naisseur.CIN;
              this.sujet.naisseur.Nom = res.data.Naisseur.Nom;
              this.sujet.naisseur.Prenom = res.data.Naisseur.Prenom;
              this.sujet.naisseur.Adresse = res.data.Naisseur.Adresse;
            } else {
              this.errNotify(res.data.message);
            }
          })
          // eslint-disable-next-line handle-callback-err
          .catch((err) => {
            this.errNotify(err);
          });
      }
    },
    // Clear Inputs Naisseur and Propraitair forms
    clearN() {
      // Naisseur
      this.sujet.naisseur.CIN = '';
      this.sujet.naisseur.Nom = '';
      this.sujet.naisseur.Prenom = '';
      this.sujet.naisseur.Adresse = '';
    },
    clearP() {
      // Propraitair
      this.sujet.proprietaire.CIN = '';
      this.sujet.proprietaire.Nom = '';
      this.sujet.proprietaire.Prenom = '';
      this.sujet.proprietaire.Adresse = '';
    },
    // Sort Cause Function
    SortCause(id) {
      const tempData = Object.assign({}, this.sortData);
      Axios.put('http://127.0.0.1:8000/api/SortCause/' + id, tempData)
        .then((res) => {
          console.log(res.data.msg);
        })
        // eslint-disable-next-line handle-callback-err
        .catch((err) => {
          this.errNotify(err);
        });
    },
    // Sort supprimer Sujet Function
    Archive() {
      Axios.delete('http://127.0.0.1:8000/api/Sujet/' + this.$route.params.id)
        .then((res) => {
          this.SortCause(this.$route.params.id);
          this.sortData.infoCause = '';
          this.sortData.SortValue = '';
          this.$notify({
            title: 'Success',
            message: 'Vache Archiver',
            type: 'success',
            duration: 2000,
          });
          this.$router.push({
            name: 'sujets',
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
    },
    // Show Sort Dialog
    Sort() {
      this.dialogFormSort = true;
    },
    // check age
    older(parentBirthDate, childeBirthDate){
      const Parent_Year = new Date(parentBirthDate).getFullYear();
      const Childe_Year = new Date(childeBirthDate).getFullYear();

      if (Parent_Year < Childe_Year){
        return true;
      } else {
        return false;
      }
    },
    // Show Data Function
    showUpdateData() {
      Axios.get('http://127.0.0.1:8000/api/Sujet/' + this.$route.params.id)
        .then((res) => {
          this.setValues(res.data.data);
          this.getIndexValues(this.$route.params.id);
        })
        .catch((err) => console.log(err));
      if (
        this.$route.params.id !== undefined &&
        this.$route.params.type === 'show'
      ) {
        this.status = 'show';
        this.openGenealogie = true;
        this.openPerformonce = true;
        this.openIndex = true;
        this.sujet.pere.remp = true;
        this.sujet.mere.remp = true;
        this.sujet.grandMereMaternell.remp = true;
        this.sujet.grandMerePaternell.remp = true;
        this.sujet.grandPerePaternell.remp = true;
        this.sujet.grandPereMaternell.remp = true;
        this.show = true;
        this.Newproprietaire = 'Exist';
        this.NewNaisse = '2';
      } else if (
        this.$route.params.id !== undefined &&
        this.$route.params.type === 'update'
      ) {
        this.update = true;
        this.Newproprietaire = 'Exist';
        this.NewNaisse = '2';
        this.openGenealogie = true;
        this.openPerformonce = true;
        this.openIndex = true;
        this.status = 'update';
      }
    },
    // Update Sujet
    UpdateSujet(msg) {
      // this.createPere();
      const tempData = Object.assign({}, this.sujet);
      Axios.put(`/api/Sujet/${tempData.id}`, tempData)

        .then((res) => {
          if (msg !== 'msg') {
            this.$notify({
              title: 'Success',
              message: res.data.Msg,
              type: 'success',
              duration: 2000,
            });
          }
          this.getIndexValues(this.sujet.id);
        })
      // eslint-disable-next-line handle-callback-err
        .catch((err) => {
          this.errNotify(err);
        });
    },
    // set Naiss Data To Prop
    NaisseurIsProp() {
      if (this.checked === true) {
        this.sujet.proprietaire.CIN = this.sujet.naisseur.CIN;
        this.sujet.proprietaire.Nom = this.sujet.naisseur.Nom;
        this.sujet.proprietaire.Prenom = this.sujet.naisseur.Prenom;
        this.sujet.proprietaire.Adresse = this.sujet.naisseur.Adresse;
      } else {
        this.sujet.proprietaire.CIN = '';
        this.sujet.proprietaire.Nom = '';
        this.sujet.proprietaire.Prenom = '';
        this.sujet.proprietaire.Adresse = '';
      }
    },
    setValues(data) {
      if (data.Etat === 'Active') {
        this.sujet.Etat = 'Active';
      } else {
        this.sujet.Etat = 'Sorte';
      }
      this.sujet.id = data.id;
      this.sujet.NTravail = data.NTravail;
      this.sujet.NSNIT = data.NSNIT;
      this.sujet.Sexe = data.Sexe;
      this.sujet.Type = data.Type;
      this.sujet.Race = data.Race;
      this.sujet.Adresse = data.Adresse;
      this.sujet.admin = data.user.name;
      this.sujet.image1=data.image1;
      this.sujet.image2=data.image2
      this.sujet.DateNaissance = moment(String(data.DateNaissance)).format(
        'yyyy-MM-DD HH:mm:ss'
      );
      this.sujet.dateCreation = moment(String(data.created_at)).format(
        'yyyy-MM-DD HH:mm:ss'
      );
      this.sujet.dateModifiaction = moment(String(data.updated_at)).format(
        'yyyy-MM-DD HH:mm:ss'
      );
      // Prop
      if (data.eleveurproprietaire) {
        this.sujet.EleveurProprietaires_ID = data.eleveurproprietaire.id;
        this.sujet.proprietaire.id = data.eleveurproprietaire.id;
        this.sujet.proprietaire.CIN = data.eleveurproprietaire.CIN;
        this.sujet.proprietaire.Nom = data.eleveurproprietaire.Nom;
        this.sujet.proprietaire.Prenom = data.eleveurproprietaire.Prenom;
        this.sujet.proprietaire.Adresse = data.eleveurproprietaire.Adresse;
      }
      // Naisseur
      if (data.eleveurnaisseur) {
        this.sujet.EleveurNaisseurs_ID = data.eleveurnaisseur.id;
        this.sujet.naisseur.id = data.eleveurnaisseur.id;
        this.sujet.naisseur.CIN = data.eleveurnaisseur.CIN;
        this.sujet.naisseur.Nom = data.eleveurnaisseur.Nom;
        this.sujet.naisseur.Prenom = data.eleveurnaisseur.Prenom;
        this.sujet.naisseur.Adresse = data.eleveurnaisseur.Adresse;
      }

      // Pere
      if (data.pere.id) {
        this.sujet.peres_ID = data.pere.id;
        this.sujet.pere.id = data.pere.id;
        this.sujet.pere.N = data.pere.N;
        this.sujet.pere.Nom = data.pere.Nom;
        this.sujet.pere.Race = data.pere.Race;
        this.sujet.pere.Datenaissance = moment(
          String(data.pere.Datenaissance)
        ).format('yyyy-MM-DD HH:mm:ss');
      }
      // Mere
      if (data.mere) {
        this.sujet.meres_ID = data.mere.id;
        this.sujet.mere.id = data.mere.id;
        this.sujet.mere.NSNIT = data.mere.NSNIT;
        this.sujet.mere.Race = data.mere.Race;
        this.sujet.mere.Datenaissance = moment(
          String(data.mere.Datenaissance)
        ).format('yyyy-MM-DD HH:mm:ss');
      }
      // Grandmere maternelle
      if (data.Grandmerematernelle) {
        this.sujet.GrandMereMaternelles_ID = data.Grandmerematernelle.id;
        this.sujet.grandMereMaternell.id = data.Grandmerematernelle.id;
        this.sujet.grandMereMaternell.NSNIT = data.Grandmerematernelle.NSNIT;
        this.sujet.grandMereMaternell.Race = data.Grandmerematernelle.Race;
        this.sujet.grandMereMaternell.Datenaissance = moment(
          String(data.Grandmerematernelle.Datenaissance)
        ).format('yyyy-MM-DD HH:mm:ss');
      }
      // Grand mere paternel
      if (data.Grandmerepaternel) {
        this.sujet.GrandMerePaternelles_ID = data.Grandmerepaternel.id;
        this.sujet.grandMerePaternell.N = data.Grandmerepaternel.N;
        this.sujet.grandMerePaternell.Race = data.Grandmerepaternel.Race;
        this.sujet.grandMerePaternell.Datenaissance = moment(
          String(data.Grandmerepaternel.Datenaissance)
        ).format('yyyy-MM-DD HH:mm:ss');
      }
      // Grand pere paternel
      if (data.Grandperepaternel) {
        this.sujet.GrandPerePaternels_ID = data.Grandperepaternel.id;
        this.sujet.grandPerePaternell.N = data.Grandperepaternel.N;
        this.sujet.grandPerePaternell.Nom = data.Grandperepaternel.Nom;
        this.sujet.grandPerePaternell.Race = data.Grandperepaternel.Race;
        this.sujet.grandPerePaternell.Datenaissance = moment(
          String(data.Grandperepaternel.Datenaissance)
        ).format('yyyy-MM-DD HH:mm:ss');
      }
      // Grand pere maternel
      if (data.Grandperematernel) {
        this.sujet.GrandPereMaternels_ID = data.Grandperematernel.id;
        this.sujet.grandPereMaternell.N = data.Grandperematernel.N;
        this.sujet.grandPereMaternell.Nom = data.Grandperematernel.Nom;
        this.sujet.grandPereMaternell.Race = data.Grandperematernel.Race;
        this.sujet.grandPereMaternell.Datenaissance = moment(
          String(data.Grandperematernel.Datenaissance)
        ).format('yyyy-MM-DD HH:mm:ss');
      }
    },
    errNotify(msg) {
      this.$notify({
        title: 'Error',
        message: msg,
        type: 'error',
        duration: 2000,
      });
    },
  },
};
</script>

<style scoped>
*{
    font-family: Montserrat,Helvetica,Arial,serif;
    font-size: 1rem;
    font-weight: 400;
    /* color: #6e6b7b; */
}
.container{
  background-color:#f8f8f8 !important;
}
.formCard {
  /* box-shadow:0 4px 24px 0 rgb(34 41 47 / 10%);
  background-color:#ffffff; */
}
.formCard label {
  /* color: rgb(131, 131, 131); */
}
.formCard .form-control:focus {
  /* box-shadow: unset; */
}
.full-width-tabs > ul.nav.nav-tabs {
  display: table;
  width: 100%;
  table-layout: fixed; /* To make all "columns" equal width regardless of content */
}
.full-width-tabs > ul.nav.nav-tabs > li {
  float: none;
  display: table-cell;
}
.full-width-tabs > ul.nav.nav-tabs > li > a {
  text-align: center;
}
.race .el-input {
  display: block !important;
  width: 100% !important;
  padding: 0.375rem 0.75rem !important;
  font-size: 1rem !important;
  font-weight: 400 !important;
  line-height: 1.5 !important;
  color: #212529 !important;
  background-color: #fff !important;
  background-clip: padding-box !important;
  border: 1px solid #ced4da !important;
  -webkit-appearance: none !important;
  -moz-appearance: none !important;
  appearance: none !important;
  border-radius: 0.25rem !important;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
}
/* .race .el-autocomplete > input[type='text']:focus {
  color: #212529 !important;
  outline: 0 !important;
  background-color: #fff !important;
  border-color: #7367f0 !important;
  box-shadow: 0 3px 10px 0 rgb(34 41 47 / 10%) !important;
} */
.race .el-input__inner {
  color: #212529 !important;
  font-size: 1rem !important;
  font-weight: 400 !important;
  line-height: 1.5 !important;
}
.race .el-autocomplete {
  display: block !important ;
}
/* .race:focus .el-autocomplete{
  background-color: #fff !important;
  border-color: #7367f0 !important;
  box-shadow: 0 3px 10px 0 rgb(34 41 47 / 10%) !important;
} */
.tab-pane .card-body {
  justify-content: space-between;
  display: flex;
  flex-direction: column;
}
.btn-success:hover {
    color: #fff;
    background-color: #7367f0;
    border-color: #4839eb;
    box-shadow: 0 3px 10px 0 rgb(34 41 47 / 10%) !important;
}
.form-control.btn-success{
    border: 1px solid #7367f0;
}
.btn-primary{
  background-color: #7367f0 !important;
}
.btn-primary:focus{
  background-color: #4839eb !important;
}
/*** Genologie forms style */
.el-date-editor.el-input,
.el-date-editor.el-input__inner {
  width: 100%;
}
.myForm {
  justify-content: space-between;
  display: flex;
  flex-direction: column;
}
/* tabs */
.tabContainer{
  /* border: none;
  border-radius: .5rem;
  overflow: hidden;
  box-shadow:0 4px 24px 0 rgb(34 41 47 / 10%);
   background-color:#ffffff; */
}
.nav .nav-tabs{
  border-bottom:none !important;
}
.nav-tabs .nav-item.show .nav-link,
.nav-tabs .nav-link ,
.nav-tabs .nav-item.show .nav-link,
.nav-tabs .nav-link:hover {
  color: #82868b;
  border-color: transparent;
  font-weight: 500;
  font-size: 1.07rem;
}
@media (max-width:600px) {
  .nav-tabs .nav-item.show .nav-link,
  .nav-tabs .nav-link ,
  .nav-tabs .nav-item.show .nav-link,
  .nav-tabs .nav-link:hover{
    font-size:.9rem !important;
  }
  .el-button{
    font-size: .8rem !important;
    padding: .7rem !important;
  }
  #app > div > div.main-container.hasTagsView > section > div > div.card.formCard.mt-6.mb-6 > div > form > div:nth-child(1) > div.el-dialog__wrapper > div{
    margin-top: 15vh !important;
    width: 100% !important;
    padding: 0px !important;
  }
  .el-form--label-left .el-form-item__label {
    text-align: left !important;
    font-size: .9rem !important;
    font-weight: 300 !important;
}
}
.nav-link:hover{
  background-color:#9f95f517;
}
.nav-tabs .nav-item.show .nav-link,
.nav-tabs .nav-link.active {
  color:#7367f0;
  background-color:none;
  border-bottom:3px solid #7367f0;
  z-index: 2;
}
/* card */
/* .card-header {
  font-weight: 800;
  color: #1890ff;
} */
/* geanlogie card */
.card{
  box-shadow:0 4px 24px 0 rgb(34 41 47 / 10%) !important;
  border-radius: .5rem;
  overflow: hidden;
}
.card .card-body label{
  color: #5e5873 !important;
  font-size: .857rem !important;
}
.card .card-body .form-control:focus,
.card .card-body .form-select:focus{
  background-color: #fff !important;
  border-color: #7367f0 !important;
  box-shadow: 0 3px 10px 0 rgb(34 41 47 / 10%) !important;
}
#nav-home div.card-header{
  font-family: inherit;
  font-weight: 500 !important;
  line-height: 1.2 !important;
  color: #7367f0 !important;
  font-size: 1.3rem !important;
  background-color:#ffff !important;
}
#nav-home div.card-body .el-button.el-button--success{
  background-color:#28c76f !important;
  width:100%;
}
#nav-home div.card-body .el-button.el-button--danger{
  background-color:#ea5455 !important;
  width:100%;
}
#nav-home div.card-body .el-button.el-button--warning{
  background-color:#ff9f43 !important;
  width:100%;
}
.disable {
  pointer-events: none;
}
/* index */
</style>

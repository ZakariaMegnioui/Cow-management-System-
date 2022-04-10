<template>
  <div class="row max-h-screen pb-32"   :class="status==='show' ? 'disable' :''">
    <!------------------- start upload les photo de la vache ------------------->
    <div class="col-lg-2 col-sm-12">
      <!-- tab Buttons  -->
      <div
        class="flex gap-5 items-centert justify-center lg:flex-col lg:justify-start lg:mt-16 lg:p-4 lg:px-4 p-4 px-12"
      >
        <button
          class="hover:bg-blue-400 font-semibold text-white py-2 px-4 border-2 border-blue-500 rounded"
          :class="tabIndex == 1 ? 'activeBtn' : 'normalBtn'"
          @click="tabIndex = 1"
        >Gauche</button>
        <button
          class="hover:bg-blue-400 font-semibold text-white py-2 px-4 border-2 border-blue-500 rounded"
          :class="tabIndex == 2 ? 'bg-blue-700' : 'bg-blue-300'"
          @click="tabIndex = 2"
        >Droit</button>
      </div>
    </div>

    <div class="col-lg-10 col-sm-12 flex justify-center items-center p-2 lg:p-5">
      <div v-if="tabIndex === 1" class="w-full relative h-full p-5">
        <!-- <div
          v-show="AlertLeftValid"
          class="absolute top-0 left-1/2 w-full transform -translate-x-1/2"
        >
          <el-alert title="success alert" type="success" show-icon />
        </div>-->
        <h4 class="text-xl uppercase font-bold text-gray-800 mb-4">Gauche</h4>
        <label
          v-if="!filePreviewLeft"
          for="product_image"
          class="flex flex-col items-center justify-center border-4 border-gray-300 border-dashed my-auto rounded h-48 px-6 text-lg text-gray-600 focus:outline-none focus:ring focus:border-blue-300 cursor-pointer"
          autocomplete="off"
        >
          <svg
            class="w-8 h-8 text-gray-600"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
            />
          </svg>
          <span

            class="mt-2 text-base leading-normal text-blue-500 font-bold"
          >Sélectionner une photo</span>
          <input
            id="product_image"
            ref="fileInput0"
            type="file"
            class="hidden"
            @change="selectImgFile(0)"
          />
        </label>

        <div v-if="filePreviewLeft" class="container" :class="status==='show' ? 'disable' :''">
          <!--start container-->
          <div class="previewBlock relative">
            <span
              class="-translate-y-1/2 absolute bg-gray-300 hover:bg-red-200 hover:text-red-600 hover:border-red-600 opacity-40 hover:opacity-100 border-2 h-8 right-0 rounded-full top-0 transform translate-x-1/2 w-8 flex justify-center items-center"
              @click="closeBtn('filePreviewLeft')"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </span>
            <img class="object-cover" :src="filePreviewLeft" alt srcset />
          </div>
          <div />
          <div class="control w-full gap-4 pt-4 flex justify-center items-center">
            <button
              class="hover:bg-green-800 bg-green-600 text-white font-semibold py-2 px-4 border-1 border-solid border-green-800 rounded-full"
              @click="valide('AlertLeftValid')"
            >Valider</button>
            <button
              class="hover:bg-orange-500 text-orange-500 font-semibold hover:text-white py-2 px-4 border-1 border-solid border-orange-500 rounded-full"
              @click="closeBtn('filePreviewLeft')"
            >Cancel</button>
          </div>
        </div>
        <!--End container-->
      </div>
      <!--Tab Inex--->

      <div v-if="tabIndex === 2" class="w-full relative h-full p-5">
        <!-- <div
          v-show="AlertRightValid"
          class="absolute top-0 left-1/2 w-full transform -translate-x-1/2"
        >
          <el-alert title="success alert" type="success" show-icon />
        </div>-->
        <h4 class="text-xl uppercase font-bold text-gray-800 mb-4">Droit</h4>
        <label
          v-if="!filePreviewRight"
          for="product_image"
          class="flex flex-col items-center justify-center border-4 border-gray-300 border-dashed my-auto rounded h-48 px-6 text-lg text-gray-600 focus:outline-none focus:ring focus:border-blue-300 cursor-pointer"
          autocomplete="off"
        >
          <svg
            class="w-8 h-8 text-gray-600"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
            />
          </svg>
          <span
            :class="status==='show' ? 'disable' :''"
            class="mt-2 text-base leading-normal text-blue-500 font-bold"
          >Sélectionner une photo</span>
          <input
            id="product_image"
            ref="fileInput1"
            type="file"
            class="hidden"
            @change="selectImgFile(1)"
          />
        </label>

        <div v-if="filePreviewRight" class="container" :class="status==='show' ? 'disable' :''">
          <!--start container-->
          <div class="previewBlock relative">
            <span
              class="-translate-y-1/2 absolute bg-gray-300 hover:bg-red-200 hover:text-red-600 hover:border-red-600 opacity-40 hover:opacity-100 border-2 h-8 right-0 rounded-full top-0 transform translate-x-1/2 w-8 flex justify-center items-center"
              @click="closeBtn('filePreviewRight')"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </span>
            <img class="object-cover" :src="filePreviewRight" alt srcset />
          </div>
          <div />
          <div class="control w-full gap-4 pt-4 flex justify-center items-center">
            <button
              class="hover:bg-green-800 bg-green-600 text-white font-semibold py-2 px-4 border-1 border-solid border-green-800 rounded-full"
              @click="valide('AlertRightValid')"
            >Valider</button>

            <button
              class="hover:bg-orange-500 text-orange-500 font-semibold hover:text-white py-2 px-4 border-1 border-solid border-orange-500 rounded-full"
              @click="closeBtn('filePreviewRight')"
            >Cancel</button>
          </div>
        </div>
        <!--End container-->
      </div>
      <!--Tab Inex--->
    </div>
    <!------------------- end upload les photo de la vache ---------------------->
  </div>
</template>

<script>
import Axios from 'axios';

export default {
  name: 'Photo',
  props: {
    // eslint-disable-next-line vue/require-prop-types
    sujet: {
      type: Object,
      default: () => {},
    },
    status: {
      Type: String,
      default: () => {},
    },
  },
  data() {
    return {
      tabIndex: 1,
      filePreviewLeft: null,
      filePreviewRight: null,
      AlertLeftValid: false,
      AlertRightValid: false,
    };
  },

  watch: {
    sujet: {
      handler( newVal,oldVal) {
        this.setPhoto(newVal);
      },
      deep: true,
    },
  },
  methods: {
    setPhoto(newVal) {


      if ( newVal.image1) {
        this.filePreviewLeft = `../storage/sujet_Images/${newVal.image1}`;

      }
      if (newVal.image2 ) {
        this.filePreviewRight = `../storage/sujet_Images/${newVal.image2}`;

      }
    },
    chooseFile(i) {
      this.$refs[`fileInput${i}`].click();
    },
    selectImgFile(i) {
      const fileInput = this.$refs[`fileInput${i}`];
      const imgFile = fileInput.files;

      if (imgFile && imgFile[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
          if (i === 0) {
            this.filePreviewLeft = e.target.result;

          } else if (i === 1) {
            this.filePreviewRight = e.target.result;
          }
        };
        reader.readAsDataURL(imgFile[0]);
        // this.$emit('fileInput', imgFile[0]);
      }
    },
    closeBtn(target) {
      if (target === 'filePreviewLeft') {
        this.filePreviewLeft = null;
        this.AlertLeftValid = false;
      } else if (target === 'filePreviewRight') {
        this.filePreviewRight = null;
        this.AlertRightValid = false;
      }
    },
    valide(target) {
      if (target === 'AlertRightValid' && this.filePreviewRight !== '') {
        this.upload(this.filePreviewRight, 'image2');

      } else if (target === 'AlertLeftValid' && this.filePreviewLeft !== '') {
        this.upload(this.filePreviewLeft, 'image1');
      }
    },
    upload(image, type) {


      Axios.put(`/api/Sujet/${this.sujet.id}`, { image: image, type: type })
        .then((res) => {
          this.$notify({
            title: 'Success',
            message: res.data.msg,
            type: 'success',
            duration: 2000,
          });
        })
        // eslint-disable-next-line handle-callback-err
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
}
.previewBlock {
  display: block;
  cursor: pointer;
  width: 300px;
  height: 280px;
  margin: 0 auto 20px;
  background-position: center center;
  background-size: cover;
}

.normalBtn {
  background-color: #7367f0;
  border-color: #7367f0;
}
.activeBtn {
  background-color: #4839eb;
  border-color: #4839eb;
}
.disable {
  pointer-events: none;
}
</style>

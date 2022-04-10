<template>
  <el-form label-position="left" label-width="120px" class="myForm h-full">
    <el-form-item
      v-for="(value, proprty, index) in items.information"
      :key="index"
      :label="proprty"
    >
      <!--{{ genealogie }}-->
      <div v-if="proprty !== 'Datenaissance'">
        <el-input v-model="items.information[proprty]" :disabled="isDisaibeld" />
      </div>
      <div v-else>
        <el-date-picker v-model="items.information[proprty]" type="date" :disabled="isDisaibeld" />
      </div>
    </el-form-item>
    <el-row type="flex" class="row-bg" justify="end">
      <el-col v-if="!isDisaibeld" :span="6">
        <el-button type="success" icon="el-icon-check" round @click="confirme">Valider</el-button>
      </el-col>
      <!-- Update  Button -->
      <el-col v-else-if="isDisaibeld" :span="6">
        <el-button type="warning" icon="el-icon-edit" round @click="update">Modifier</el-button>
      </el-col>
      <el-col :span="6">
        <el-button type="danger" icon="el-icon-close" round @click="cancel($event)">Annuler</el-button>
      </el-col>
      <!--  Archive Buttpons  -->
      <!--          <el-col :span="6">
                <el-button type="danger" icon="el-icon-folder-delete" round plain @click="archive">Archiver</el-button>
              </el-col>
      -->
    </el-row>
  </el-form>
</template>

<script>
export default {
  props: {
    items: {
      type: Object,
      default: () => { },
    },
    disaibeld: {
      type: Boolean,
      default: false,
    },
    genealogie: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      isDisaibeld: false,
    };
  },
  methods: {
    confirme() {
      this.$emit('genealogie', this.genealogie);
      this.isDisaibeld = !this.isDisaibeld;
    },
    update(){
      this.isDisaibeld = false;
    },
    cancel($event){
      this.isDisaibeld = false;
    },
  },
};
</script>

<style>
.el-date-editor.el-input,
.el-date-editor.el-input__inner {
  width: 100%;
}
.myForm{
  justify-content: space-between;
  display: flex;
  flex-direction: column;

}
/* .el-date-editor.el-input, .el-date-editor.el-input__inner */
</style>

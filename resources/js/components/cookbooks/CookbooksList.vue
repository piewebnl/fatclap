<template>
  <div class="table">
    <template v-for="(cookbook, index) in cookbooks">
      <Cookbook
        :key="index"
        :name="cookbook.name"
        :showName="true"
        :showEdit="true"
        :id="cookbook.id"
      ></Cookbook>
    </template>
  </div>
</template>

<script>
import Cookbook from "@/components/cookbooks/Cookbook";

export default {
  components: {
    Cookbook,
  },

  props: {
    cookbooks: {
      type: Array,
      default() {
        return [];
      },
      required: true,
    },
  },
};
</script>


<template>
  <div class="table">
    <template v-for="(mealtype, index) in mealtypes">
      <Mealtype
        :key="index"
        :name="mealtype.name"
        :color="mealtype.color"
        :showName="true"
        :showEdit="true"
        :id="mealtype.id"
      ></Mealtype>
    </template>
  </div>
</template>

<script>
import Mealtype from "@/components/mealtypes/Mealtype";

export default {
  components: {
    Mealtype,
  },

  props: {
    mealtypes: {
      type: Array,
      default() {
        return [];
      },
      required: true,
    },
  },
};
</script>


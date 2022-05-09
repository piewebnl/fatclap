<template>
  <div class="table-row">
    <div class="table-cell align-middle p-2">{{ name }}</div>
    <div class="table-cell align-middle p-2">
      <router-link
        v-if="showEdit"
        :to="{
          name: 'cookbooks.edit',
          params: { id: id },
        }"
        class="btn"
      >
        <ion-icon name="pencil-sharp"></ion-icon>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      type: Number,
      required: true,
      default: null,
    },
    name: {
      type: String,
      required: true,
      default: "",
    },
    showName: {
      type: Boolean,
      required: false,
      default: true,
    },
    showEdit: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
};
</script>

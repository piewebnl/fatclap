<template>
  <div class="table-row">
    <div class="table-cell align-middle p-2">
      <MealtypeLetter :letter="name[0]" :color="color"></MealtypeLetter>
    </div>
    <div v-if="showName === true" class="table-cell align-middle p-2">
      {{ name }}
    </div>
    <div class="table-cell align-middle p-2">
      <router-link
        v-if="showEdit"
        :to="{ name: 'mealtypes.edit', params: { id: id } }"
        class="btn m-0"
      >
        <ion-icon name="pencil-sharp"></ion-icon>
      </router-link>
    </div>
  </div>
</template>

<script>
import MealtypeLetter from "@/components/mealtypes/MealtypeLetter";

export default {
  components: {
    MealtypeLetter,
  },

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
    color: {
      type: String,
      required: false,
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


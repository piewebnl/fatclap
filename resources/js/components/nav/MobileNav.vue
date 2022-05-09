<template>
  <div v-if="menuOpened" class="fixed w-50 z-10 top-0 h-full bg-white p-4">
    <div class="w-full flex justify-end">
      <button @click="closeMenu()">
        <ion-icon name="close-circle-outline"></ion-icon>
      </button>
    </div>
    <nav class="flex flex-col wrap">
      <router-link
        v-for="(menuButton, index) in menuButtons"
        v-model="view"
        :key="index"
        :class="`menu-link ${menuButton.name}`"
        :to="{ name: menuButton.name }"
        v-on:click.native="closeMenu"
        v-if="allowedToView(menuButton.guest)"
        >{{ menuButton.label }}</router-link
      >

      <div class="py-2"></div>

      <div v-if="!userLoggedIn">
        <a href="/login" class="menu-link">Login</a>
      </div>

      <div v-if="userLoggedIn">
        <form name="logout" action="/logout" method="post">
          <input type="hidden" name="_token" id="csrf-token" :value="csrf" />
          <button type="submit" class="menu-link">Logout</button>
        </form>
      </div>
    </nav>
  </div>
</template>

<script>
import Options from "@/components/options/Options";

export default {
  props: {
    menuOpened: {
      type: Boolean,
      default: false,
    },
    menuButtons: {
      type: Array,
    },
  },
  components: {
    Options,
  },
  computed: {
    userLoggedIn: {
      get() {
        return this.$store.state.userLoggedIn;
      },
    },
  },

  data() {
    return {
      csrf: document.head.querySelector('meta[name="csrf-token"]').content,
      view: "/",
      showOptions: false,
    };
  },

  methods: {
    closeMenu() {
      this.$emit("emitClicked", false);
    },
    allowedToView(guest) {
      if (guest) return true;
      if (this.userLoggedIn) return true;
    },
  },
};
</script>

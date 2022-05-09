<template>
  <div id="site" class="max-w-1920 m-auto">
    <div
      class="bg-black w-full h-full opacity-50 absolute cursor-pointer"
      v-if="menuOpened"
      @click="closeMenu()"
    ></div>

    <header class="sticky top-0 w-full z-10">
      <div
        class="
          flex
          justify-between
          w-full
          p-4
          bg-gradient-to-l
          from-zest
          to-white
          border-b-1 border
        "
      >
        <div class="flex-1">
          <h1>
            <a href="/" class="text-zest text-4xl hover:no-underline"
              >FatClap</a
            >
          </h1>
        </div>
        <button
          v-if="screenWidth <= mobileMenuBreakpoint"
          @click="menuOpened = !menuOpened"
          class="btn bg-white"
        >
          <ion-icon name="menu"></ion-icon>
        </button>
      </div>
      <div class="flex justify-center w-full bg-white bg-opacity-75">
        <Messages></Messages>
      </div>
    </header>

    <MainNav
      @emitClicked="closeMenu()"
      :menuOpened="menuOpened"
      :mobileMenuBreakpoint="mobileMenuBreakpoint"
      v-if="$route.fullPath != '/404'"
    ></MainNav>

    <section id="content" class="p-4 m-auto">
      <div v-if="userLoggedIn" class="w-full m-auto p-4">
        <router-view></router-view>
      </div>
      <div class="w-full text-center m-auto p-4" v-else>
        Welcome, please <a href="/login">login!</a>
      </div>
    </section>
  </div>
</template>

<script>
import MainNav from "@/components/nav/MainNav";
import Messages from "@/components/messages/Messages";
import CookieMixin from "@/mixins/CookieMixin";

export default {
  mixins: [CookieMixin],

  components: {
    MainNav,
    Messages,
  },

  data() {
    return {
      mobileMenuBreakpoint: 768,
      menuOpened: false,
      screenWidth: 0,
    };
  },
  watch: {
    $route(to, from) {
      this.menuOpened = false;
    },
    user(old) {
      if (old.name != "") {
        this.userLoggedIn = true;
      }
    },
  },

  computed: {
    user: {
      get() {
        return this.$store.state.user;
      },
    },
    userLoggedIn: {
      get() {
        return this.$store.state.userLoggedIn;
      },
      set(value) {
        this.$store.commit("updateUserLoggedIn", value);
      },
    },
    showNutritionCounter: {
      get() {
        return this.$store.state.showNutritionCounter;
      },
      set(value) {
        this.$store.commit("updateShowNutritionCounter", value);
      },
    },
    messages: {
      get() {
        return this.$store.state.messages;
      },
      set(value) {
        this.$store.commit("updateMessages", value);
      },
    },
  },
  methods: {
    closeMenu() {
      this.menuOpened = false;
    },
    onResize() {
      this.screenWidth = window.innerWidth;
    },
  },

  created() {
    this.$store.dispatch("loadUser");
    this.screenWidth = window.innerWidth;
    this.getCookieMixin("showNutritionCounter", "boolean");
  },

  mounted() {
    this.$nextTick(() => {
      window.addEventListener("resize", this.onResize);
    });
  },

  beforeDestroy() {
    window.removeEventListener("resize", this.onResize);
  },
};
</script>


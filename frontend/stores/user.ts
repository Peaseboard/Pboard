export const useUserStore = defineStore("user", () => {
  const user = useState("user", () => ({
    id: null,
    email: "",
    plan_name: "",
    balance: 0,
    transfer_enable: 0,
    u: 0,
    d: 0,
    expired_at: null,
  }));

  const isLoggedIn = computed(() => !!user.value.id);

  async function fetchUser(token: string) {
    const res = await \("/api/v1/user/me", {
      headers: { Authorization: token },
    });
    user.value = res.data;
  }

  return { user, isLoggedIn, fetchUser };
});

const state = {
  errors:[1,2]
}

const mutations = {
}

const actions = {
  registration({ commit }) {
    fetch("/api/user", {
      method: 'post',
      body: dataToJson
      });
  },
  auth({ commit }){
    fetch("/api/auth", {
      method: 'post',
      body: dataToJson
    });
  }
}

const getters = {
  checkForm(state, { email, pass }) {
    console.log('from getter in store "form" :', email, pass);

    const reEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const rePass = /^(?=.*[0-9]+.*)(?=.*[a-zA-Z]+.*)[0-9a-zA-Z]{6,}$/;

    if(email && pass) return true;

    state.errors = [];

    if(!email) {
      state.errors.push("Email required");
    } else if(!reEmail.test(email)) {
      state.errors.push("Please enter valid email address");
    }

    if(!pass) {
      state.errors.push("Password required");
    } else if(pass.length < 6) {
      state.errors.push("Password must be longer than six charaters");
    } else if(!rePass.test(pass)) {
      state.errors.push("Password must contain at least one letter, at least one number,");
    }

    return false;
  },
  getErrors(state) {
    return state.errors;
  }
}

export default {
  state,
  mutations,
  actions,
  getters
}

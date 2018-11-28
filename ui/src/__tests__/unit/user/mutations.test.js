import user from "../../../store/modules/user"
const { mutations } = user;

describe("User mutations", () => {
  const state = {
    token: ''
  }

  it("SET_TOKEN", () => {
    const token = 'token';
    
    mutations.SET_TOKEN(state, token)

    expect(state).toEqual({
      token: 'token'
    })
  })

  it("LOGOUT", () => {
    mutations.LOGOUT(state)

    expect(state).toEqual({
      token: ''
    })
  })
})
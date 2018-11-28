import user from "../../store/modules/user"
const { getters } = user;

describe("User getters", () => {
  const state = {
    user: 'email@email.com',
    token: 'token'
  }

  it("getUser", () => {
    const actual = getters.getUser(state)

    expect(actual).toEqual('email@email.com')
  })

  it("getToken", () => {
    const actual = getters.getToken(state)

    expect(actual).toEqual('token')
  })

  it("isAuthenticated", () => {
    const actual = getters.isAuthenticated(state)

    expect(actual).toEqual(true)
  })
})
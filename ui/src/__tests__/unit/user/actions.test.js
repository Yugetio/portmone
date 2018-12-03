import user from "../../../store/modules/user"
const { actions } = user;

let url = ''
let body = {}
let mockError = false

jest.mock("axios", () => ({
  post: (_url, _body) => {
    return new Promise((resolve) => {
      if (mockError)
        throw Error("Mock error")

      url = _url
      body = _body
      resolve(true)
    })
  }
}))


describe("User action", () => {
  it("authenticated a user", () => {
    const commit = jest.fn()
    const email = "user@email.com"
    const password = "password"

    actions.LOGIN({ commit }, { email, password })
    .catch(() => {})

    expect(url).toBe("/auth")
    expect(body).toEqual({ email, password })
  })

  it("catches an error", () => {
    mockError = true

    expect(actions.LOGIN({ commit: jest.fn() }, {}))
      .rejects.toThrow("Mock error")
  })
})
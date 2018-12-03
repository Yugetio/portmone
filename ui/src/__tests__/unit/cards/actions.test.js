import user from "../../../store/modules/cards"
const { actions } = user;

let url = ''
let body = {}
let mockError = false

function mockFn (_url, _body) {
  return new Promise((resolve) => {
    if (mockError)
      throw Error("Mock error")

    url = _url
    body = _body
    resolve(true)
  })
}

jest.mock("axios", () => ({
  post: mockFn,
  get: mockFn,
  put: mockFn,
  delete: mockFn
}))


describe("Cards action", () => {
  it("get cards from server", () => {
    const commit = jest.fn()
    const folderId = 1

    actions.GET_CARDS({ commit }, folderId)

    expect(url).toBe("/card")
    expect(body).toEqual(1)
  })

  it("Create card", () => {
    const dispatch = jest.fn()
    const number = 324234242
    const cash = 23423

    actions.CREATE_CARD({ dispatch }, { number, cash })

    expect(url).toBe("/card")
    expect(body).toEqual({ number, cash })
  })

  it("Edit card", () => {
    const dispatch = jest.fn()
    const id = 1
    const number = 324234242
    const cash = 23423
  
    actions.EDIT_CARD({ dispatch }, { id, number, cash })
  
    expect(url).toBe("/card")
    expect(body).toEqual({id, number, cash })
  })

  it("Delete card", () => {
    const dispatch = jest.fn()
    const id = 1
 
    actions.DELETE_CARD({ dispatch }, id)
  
    expect(url).toBe("/card")
    expect(body).toEqual(id)
  })

  // it("catches an error in action GET_CARDS", () => {
  //   mockError = true

  //   expect(actions.GET_CARDS({ commit: jest.fn() }, {}))
  //     .rejects.toThrow("Mock error")
  // })

})

import store from "../../store/modules/popUp"
const { getters } = store;

describe("Popup getters", () => {
  const state = {
    tempData: {
      id: null,
      parentId: null,
      name: 'a'
    }
  }

  it("getTempDataInPopUp", () => {
    const actual = getters.getTempDataInPopUp(state)

    expect(actual).toEqual({
      id: null,
      parentId: null,
      name: 'a'
    })
  })
})
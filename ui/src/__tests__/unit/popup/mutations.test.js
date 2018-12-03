import store from "../../../store/modules/popUp"
const { mutations } = store;

describe("Popup mutations", () => {
  const state = {
    show: null,
    tempData: null
  }

  it("show popup", () => {
    const data = {
      id: null,
      parentId: null,
      name: 'a'
    };
    
    mutations.SHOW_CREATE_OR_EDIT_BLOCK(state, {name: 'card', data})

    expect(state).toEqual({
      show: 'card',
      tempData: {
        id: null,
        parentId: null,
        name: 'a'
      }
    })
  })

  it("hide popup", () => {
    mutations.HIDE_CREATE_OR_EDIT_BLOCK(state)

    expect(state).toEqual({
      show: null,
      tempData: null
    })
  })
})
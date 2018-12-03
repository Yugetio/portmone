import store from "../../../store/modules/cards"
const { mutations } = store;

describe("Cards mutation", () => {
  const state = {
    cards: []
  }

  it("Set cards", () => {
    const data = [{
      id: 1,
      number: '1111111111111',
      cash: '121'
    },
    {
      id: 2,
      number: '22222222222222',
      cash: '121'
    }]
    
    mutations.SET_CARDS(state, data)

    expect(state).toEqual({
      cards: data
    })
  })
})
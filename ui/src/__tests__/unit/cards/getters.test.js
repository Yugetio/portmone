import store from "../../../store/modules/cards"
const { getters } = store;

describe("Cards getter", () => {
  const state = {
    cards: [{
      id: 1,
      number: '1111111111111',
      cash: '121'
    },
    {
      id: 2,
      number: '22222222222222',
      cash: '121'
    }]
  }

  it("get cards", () => {
    const actual = getters.getCards(state)

    expect(actual).toEqual([{
      id: 1,
      number: '1111111111111',
      cash: '121'
    },
    {
      id: 2,
      number: '22222222222222',
      cash: '121'
    }])
  })
})
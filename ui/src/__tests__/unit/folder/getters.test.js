import store from "../../../store/modules/folder"
const { getters } = store;

describe("Folders getters", () => {
  const state = {
    folders: [
      {
        nameFolder: 'a',
        id: 1,
        parentId: null
      }
    ],
     currentFolder: {
       id: null,
       parentId: null,
       nameFolder: ''
     } 
  }

  it("Get folders", () => {
    const actual = getters.getFolders(state)

    expect(actual).toEqual([
      {
        nameFolder: 'a',
        id: 1,
        parentId: null
      }
    ])
  })

  it("Get current folder", () => {
    const actual = getters.getCurrentFolder(state)

    expect(actual).toEqual({
      id: null,
      parentId: null,
      nameFolder: ''
    })
  })
})
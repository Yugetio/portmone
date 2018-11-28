import store from "../../../store/modules/folder"
const { mutations } = store;

describe("Folders mutations", () => {
  const state = {
    folders: [],
    currentFolder: {}
  }

  it("Set folders", () => {
    const data = [
      {
        nameFolder: 'a',
        id: 1,
        parentId: null
      }
    ]
    
    mutations.SET_FOLDERS(state, data)

    expect(state.folders).toEqual([
      {
        nameFolder: 'a',
        id: 1,
        parentId: null
      }
    ])
  })

  it("Set current folder", () => {
    const data = {
      nameFolder: 'b',
      id: 3,
      parentId: null
    }
    
    mutations.SET_CURRENT_FOLDER(state, data)

    expect(state.currentFolder).toEqual({
      nameFolder: 'b',
      id: 3,
      parentId: null
    })
  })
})
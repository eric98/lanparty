import * as types from '../../mutation-types'

export default {
  [ types.SELECTED_USER ] (state, user) {
    state.selected_user = user
  }
}

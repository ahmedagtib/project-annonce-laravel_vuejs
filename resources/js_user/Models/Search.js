import axios from 'axios';

export default class Search {

  constructor(filters) {
    this.state = {
      filters
    }
  }

  async search($Progress, page) {
    $Progress.start();
    // this.state.result = await axios.post('/api/search', this.state.filters.query);
    try {
      this.state.result = await axios.post(`/api/search?page=${page}`, this.state.filters);
      $Progress.finish();
    } catch(err) {
      console.log(err);
    }

    console.log("Search Class", this.state);

  }

}

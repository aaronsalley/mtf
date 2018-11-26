'use strict';

import React, {Component} from 'react';

import '../../assets/scss/style.scss';

class Person extends Component {
  constructor(props) {
    super(props);

    this.state = {
    };
  }

  public starRating = (rating) => {
    return(
      <div>
        <i className="material-icons">star</i>
        <i className="material-icons">star</i>
        <i className="material-icons">star</i>
        <i className="material-icons">star</i>
        <i className="material-icons">star</i>
      </div>
    );
  }

  public render() {
    const name = 'Full Name';
    const union = 'Union';
    const acting = this.starRating(5);
    const singing = this.starRating(5);
    const dancing = this.starRating(5);
    const type = 'Types';

    return(
      <article>
        <section className="grid-container">
          <div className="grid-x small-4">
            <a href="#"></a>
            <menu className="cell small-4">
              <a href="#">Photos</a>
              <a href="#">Video</a>
              <a href="#">Audio</a>
            </menu>
          </div>
          <h1>{name}</h1>
          <h4>{union}</h4>
          <div>
            {acting}
            {singing}
            {dancing}
          </div>
          <div>
            {type}
          </div>
          <aside className="grid-x small-4">
            <button></button>
            <button></button>
            <button></button>
            <button></button>
          </aside>
        </section>
        <table>
          <tbody>
            <tr>
              <td>Age range</td>
              <td>weight</td>
              <td>eye color</td>
              <td>ethnicities</td>
              <td>vocal range</td>
              <td>height</td>
              <td>figure</td>
              <td>hair color</td>
            </tr>
          </tbody>
        </table>
      </article>
    );
  }
}

export default Person;

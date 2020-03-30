import React from "react";
import axios from "axios";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";

const sweet = withReactContent(Swal);

export default class LogoSlider extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      slider: []
    };

    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleChangeSlider = this.handleChangeSlider.bind(this);
    this.handleDeleteImg = this.handleDeleteImg.bind(this);
  }

  async componentDidMount() {
    const { data } = await axios.post("/content/list");

    if (data.status === true && data.data.slider !== null) {
      this.setState({
        slider: data.data.slider
      });
    }
  }

  handleChangeSlider(event) {
    let slider = this.state.slider;
    slider.push({
      url: URL.createObjectURL(event.target.files[0]),
      file: event.target.files[0]
    });

    this.setState({ slider });
  }

  async handleSubmit() {
    if (this.state.slider.length === 0) {
      sweet.fire("Slider secin");
    }

    let formData = new FormData();

    for (let a = 0; a < this.state.slider.length; a++) {
      formData.set(a, this.state.slider[a].file);
    }

    const { data } = await axios
      .post("/sliderupdate", formData, {
        headers: {
          "content-type": "multipart/form-data" // do not forget this
        }
      })
      .catch(e => sweet.fire("Kayit sirasinda hata olustu"));

    if (typeof data !== "undefined" && data.status === true) {
      sweet.fire("İçerik guncellendi");
    } else {
      sweet.fire(data.text);
    }
  }

  handleDeleteImg(key) {
    let slider = this.state.slider;
    slider.splice(key, 1);
    this.setState({ slider });
    this.handleSubmit();
  }

  render() {
    return (
      <React.Fragment>
        <div className="col-12 grid-margin stretch-card">
          <div className="card">
            <div className="card-body">
              <div className="form-group">
                <label>Slider icin gorsel ekleyin</label>
              </div>
              <div className="text-center mx-auto">
                {this.state.slider.length > 0 &&
                  this.state.slider.map((val, key) => (
                    <img
                      key={key}
                      src={val.url}
                      onClick={() => this.handleDeleteImg(key)}
                      style={{ width: "100px", height: "100px" }}
                      className="img-thumbnail mx-auto"
                    />
                  ))}
                <label htmlFor="upload">
                  <span
                    className="glyphicon glyphicon-folder-open align-self-center"
                    aria-hidden="true"
                  >
                    <i className="icon-circle-plus icon-lg text-success" />
                  </span>
                  <input
                    type="file"
                    id="upload"
                    style={{ display: "none" }}
                    onChange={this.handleChangeSlider}
                  />
                </label>
              </div>
              <div className="row display-3">
                <button
                  type="button"
                  className="btn btn-success font-weight-bold mx-auto mt-4"
                  onClick={this.handleSubmit}
                >
                  <span className="badge">
                    <i className="icon-circle-plus" />
                  </span>
                  <span>Slider Ekle</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </React.Fragment>
    );
  }
}

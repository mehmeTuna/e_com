import React from "react";
import axios from "axios";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";

const sweet = withReactContent(Swal);

export default class Gallery extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      gallery: []
    };

    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleChangeImg = this.handleChangeImg.bind(this);
    this.handleDeleteImg = this.handleDeleteImg.bind(this);
  }

  async componentDidMount() {
    const { data } = await axios.post("/content/list");

    if (data.status === true && data.data.gallery !== null) {
      this.setState({
        gallery: data.data.gallery
      });
    }
  }

  handleChangeImg(event) {
    let gallery = this.state.gallery;
    gallery.push({
      url: URL.createObjectURL(event.target.files[0]),
      file: event.target.files[0]
    });

    this.setState({ gallery });
  }

  handleDeleteImg(key) {
    let gallery = this.state.gallery;
    gallery.splice(key, 1);
    this.setState({ gallery });
    this.handleSubmit();
  }

  async handleSubmit() {
    if (this.state.gallery.length === 0) {
      sweet.fire("Birkac gorsel secin");
    }

    let formData = new FormData();

    for (let a = 0; a < this.state.gallery.length; a++) {
      formData.set(a, this.state.gallery[a].file);
    }

    const { data } = await axios
      .post("/galleryupdate", formData, {
        headers: {
          "content-type": "multipart/form-data" // do not forget this
        }
      })
      .catch(e => sweet.fire("Kayit sirasinda hata olustu"));

    if (typeof data !== "undefined" && data.status === true) {
      sweet.fire("İçerik güncellendi");
    } else {
      sweet.fire(data.text);
    }
  }

  render() {
    return (
      <React.Fragment>
        <div className="col-12 grid-margin stretch-card">
          <div className="card">
            <div className="card-body">
              <div className="form-group">
                <label>Galeri icin gorsel ekleyin</label>
              </div>
              <div className="text-center mx-auto">
                <div>
                  {this.state.gallery.length > 0 &&
                    this.state.gallery.map((val, key) => (
                      <React.Fragment key={key}>
                        <img
                          src={val.url}
                          onClick={() => this.handleDeleteImg(key)}
                          style={{ width: "100px", height: "100px" }}
                          className="img-thumbnail mx-auto"
                        />
                      </React.Fragment>
                    ))}
                </div>
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
                    onChange={this.handleChangeImg}
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
                  <span>Gorselleri Ekle</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </React.Fragment>
    );
  }
}

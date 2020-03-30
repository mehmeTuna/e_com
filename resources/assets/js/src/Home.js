import React from "react";
import axios from "axios";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";

const sweet = withReactContent(Swal);

export default class Home extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      aboutText: "",
      addressText: "",
      emailText: "",
      phoneText: "",
      logo: []
    };

    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleChangeImg = this.handleChangeImg.bind(this);
    this.handleSubmitImg = this.handleSubmitImg.bind(this);
  }

  handleChangeImg(event) {
    let logo = [
      {
        url: URL.createObjectURL(event.target.files[0]),
        file: event.target.files[0]
      }
    ];

    this.setState({ logo });
  }

  async componentDidMount() {
    const { data } = await axios.post("/content/list");

    if (data.status === true) {
      this.setState({
        addressText: data.data.address,
        emailText: data.data.email,
        aboutText: data.data.about,
        phoneText: data.data.phone,
        logo: data.data.logo
      });
    }
  }

  async handleSubmit() {
    const { data } = await axios
      .post("/content/ekle", {
        about: this.state.aboutText,
        address: this.state.addressText,
        email: this.state.emailText,
        phone: this.state.phoneText
      })
      .catch(e => sweet.fire("Kayit sirasinda hata olustu"));

    if (typeof data !== "undefined" && data.status === true) {
      sweet.fire("Icerik eklendi");
      this.setState({
        addressText: data.address,
        emailText: data.email,
        aboutText: data.about,
        phoneText: data.phone
      });
    } else {
      sweet.fire(data.text);
    }
  }

  async handleSubmitImg() {
    if (this.state.logo.length === 0) {
      sweet.fire("Logo secin");
    }

    let formData = new FormData();

    for (let a = 0; a < this.state.logo.length; a++) {
      formData.set(a, this.state.logo[a].file);
    }

    const { data } = await axios
      .post("/logoupdate", formData, {
        headers: {
          "content-type": "multipart/form-data" // do not forget this
        }
      })
      .catch(e => sweet.fire("Kayit sirasinda hata olustu"));

    if (typeof data !== "undefined" && data.status === true) {
      sweet.fire("Icerik eklendi");
      this.setState({
        logo: data.data.logo
      });
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
                <label>Logo icin gorsel ekleyin</label>
              </div>
              <div className="text-center w-25 mx-auto">
                {this.state.logo.length > 0 &&
                  this.state.logo.map((val, key) => (
                    <div key={key}>
                      <img
                        src={val.url}
                        style={{ width: "100px", height: "100px" }}
                        className="img-thumbnail mx-auto"
                      />
                    </div>
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
                    onChange={this.handleChangeImg}
                  />
                </label>
              </div>
              <div className="row display-3">
                <button
                  type="button"
                  className="btn btn-success font-weight-bold mx-auto mt-4"
                  onClick={this.handleSubmitImg}
                >
                  <span className="badge">
                    <i className="icon-circle-plus" />
                  </span>
                  <span>Logo Ekle</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div className="col-12 grid-margin stretch-card">
          <div className="card">
            <div className="card-body">
              <div className="form-group">
                <label>Hakkında kısmı için içerik girin</label>
                <textarea
                  className="form-control"
                  rows="10"
                  value={this.state.aboutText}
                  onChange={e => this.setState({ aboutText: e.target.value })}
                  placeholder="Hakkında kısmı için içerik girin"
                ></textarea>
              </div>
              <div className="form-group">
                <label>Adres kısmı için içerik girin</label>
                <textarea
                  className="form-control"
                  rows="10"
                  value={this.state.addressText}
                  onChange={e => this.setState({ addressText: e.target.value })}
                  placeholder="Adres kısmı için içerik girin"
                ></textarea>
              </div>
              <div className="form-group">
                <label>Email kısmı için içerik girin</label>
                <input
                  className="form-control"
                  type="text"
                  value={this.state.emailText}
                  onChange={e => this.setState({ emailText: e.target.value })}
                  placeholder="Email kısmı için içerik girin"
                />
              </div>
              <div className="form-group">
                <label>Telefon kısmı için içerik girin</label>
                <input
                  className="form-control"
                  type="text"
                  value={this.state.phoneText}
                  onChange={e => this.setState({ phoneText: e.target.value })}
                  placeholder="Telefon kısmı için içerik girin"
                />
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
                  <span>İçerik Ekle</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </React.Fragment>
    );
  }
}

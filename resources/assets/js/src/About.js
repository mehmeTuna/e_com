import React from "react";
import axios from "axios";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";

const sweet = withReactContent(Swal);

export default class Hakkinda extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      content: "",
      contentEn: "",
      contentList: []
    };

    this.newContent = this.newContent.bind(this);
    this.getContent = this.getContent.bind(this);
  }

  async componentDidMount() {
    await this.getContent();

    console.log(this.state);
  }

  async getContent() {
    const { data } = await axios.post("/content/list");

    if (data.status === true) {
      this.setState({ contentList: data.about });
    }
  }

  async newContent() {
    if (this.state.content === "") {
      sweet.fire("Gerekli alanlari doldurunuz");
      return;
    }

    const { data } = await axios.post("/content/ekle", {
      about: this.state.content,
      en: this.state.contentEn
    });

    if (data.status === true) {
      sweet.fire("Icerik eklendi");
      this.getContent();
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
                <label>
                  Hakkında kısmı için içerik girin <br /> Türkçe
                </label>
                <textarea
                  className="form-control"
                  rows="10"
                  value={this.state.content}
                  onChange={e => this.setState({ content: e.target.value })}
                  placeholder="Hakkında kısmı için içerik girin"
                ></textarea>
              </div>
              <div className="form-group">
                <label>İngilizce</label>
                <textarea
                  className="form-control"
                  rows="10"
                  value={this.state.contentEn}
                  onChange={e => this.setState({ contentEn: e.target.value })}
                  placeholder="Hakkında kısmı için içerik girin"
                ></textarea>
              </div>
              <div className="row display-3">
                <button
                  type="button"
                  className="btn btn-success font-weight-bold mx-auto mt-4"
                  onClick={this.newContent}
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
        {this.state.contentList.length === 0 && (
          <h1 className="mx-auto mt-4">İçerik Yok</h1>
        )}
        {this.state.contentList.length > 0 && (
          <div className="col-12 grid-margin stretch-card">
            <div className="card">
              <div className="card-body">
                <h4 className="card-title">Hakkıda Kısmı Türkçe</h4>
                <p className="card-description"></p>
                <p>{this.state.contentList[0].site_description}</p>
              </div>
            </div>
          </div>
        )}
        {this.state.contentList.length > 0 && (
          <div className="col-12 grid-margin stretch-card">
            <div className="card">
              <div className="card-body">
                <h4 className="card-title">Hakkıda Kısmı İngilizce</h4>
                <p className="card-description"></p>
                <p>{this.state.contentList[0].des_en}</p>
              </div>
            </div>
          </div>
        )}
      </React.Fragment>
    );
  }
}

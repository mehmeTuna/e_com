import React, {useState, useRef} from 'react'
import JoditEditor from 'jodit-react'
import Axios from 'axios'
import renderHTML from 'react-render-html'

const MyEditor = ({blog, blogUpdate}) => {
  const editor = useRef(null)
  const [content, setContent] = useState('')

  const config = {
    readonly: false // all options from https://xdsoft.net/jodit/doc/
  }

  return (
    <JoditEditor
      ref={editor}
      value={blog}
      config={config}
      tabIndex={1} // tabIndex of textarea
      onBlur={newContent => blogUpdate(newContent)} // preferred to use only this option to update the content for performance reasons
      onChange={newContent => {}}
    />
  )
}

const BlogList = ({blogs, deleteBlog}) => {
  return (
    <div className="list-group">
      {blogs.map((blog, key) => (
        <div
          key={key}
          href={`/icerik/${blog.url}`}
          className="list-group-item list-group-item-action flex-column align-items-start"
        >
          <a href={`/icerik/${blog.url}`}>
            <div className="d-flex w-100 justify-content-between">
              <h5 className="mb-1">
                {renderHTML(blog.title.substring(0, 20))}
              </h5>
              <small>{blog.created_at}</small>
            </div>
          </a>
          <div className="d-flex justif-content-end align-items-center">
            <div className="flex-fill">
              <p className="mb-1">{renderHTML(blog.title.substring(0, 20))}</p>
              <small>{renderHTML(blog.title)}</small>
            </div>
            <div>
              <button
                type="button"
                className="btn btn-warning"
                onClick={e => deleteBlog(blog.id)}
              >
                Sil
              </button>
            </div>
          </div>
        </div>
      ))}
    </div>
  )
}

export default class Content extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      blogs: [],
      blog: '',
      title: ''
    }
    this.newBlog = this.newBlog.bind(this)
    this.deleteBlog = this.deleteBlog.bind(this)
  }

  async componentDidMount() {
    const {data} = await Axios.get('/v1/blogs')

    this.setState({blogs: data})
  }

  async newBlog() {
    if (this.state.blog === '' || this.state.title === '') {
      alert('Gerekli Alanlari doldurunuz')
      return
    }

    const {data} = await Axios.post('/v1/blog', {
      content: this.state.blog,
      title: this.state.title
    })

    if (data.status == true) {
      location.reload()
    }
  }

  async deleteBlog(id) {
    const {data} = await Axios.delete(`/v1/blog/${id}`)

    if (data.status == true) {
      location.reload()
    }
  }

  render() {
    return (
      <>
        <h3 className="my-4 text-center">Yeni Blog Yazisi Ekle</h3>
        <div className="form-group">
          <label className="text-center">Makale Basligi</label>
          <input
            value={this.state.title}
            onChange={e => this.setState({title: e.target.value})}
            type="email"
            className="form-control"
          />
        </div>
        <div>
          <MyEditor
            blog={this.state.blog}
            blogUpdate={e => this.setState({blog: e})}
          />
        </div>
        <div className="text-right mt-2">
          <button
            type="button"
            className="btn btn-success"
            onClick={this.newBlog}
          >
            Yaziyi Ekle
          </button>
        </div>
        {this.state.blogs.length == 0 ? (
          <h3 className="my-4 text-center">
            Yeni Bir Tane Blog Yazisi Olsuturun
          </h3>
        ) : (
          <>
            <h3 className="my-4 text-center">Blog Yazilari</h3>
            <div className="mt-2">
              <BlogList deleteBlog={this.deleteBlog} blogs={this.state.blogs} />
            </div>
          </>
        )}
      </>
    )
  }
}

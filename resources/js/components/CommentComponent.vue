<template>
  <div class="">
    <!-- comment form -->
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card border-info mb-3">
          <div class="card-header">内容来源&nbsp;<a href="https://linux.cn/" target="_blank">Linux 中国</a>，如有不同观点，请楼下排队吐槽 😁</div>
          <div class="card-body text-info" style="padding: 0.5rem;">
            <el-form ref="commentFormRef" :model="commentForm" :rules="commentRule" size="mini">
              <el-form-item prop="content" label="">
                <el-input type="textarea" v-model="commentForm.content" required rows="3"></el-input>
                <small v-show="commentContentLength" class="word-counter">{{ commentContentLength }}/225</small>
              </el-form-item>
            </el-form>
            <el-row>
              <el-col :span="8">
                <verify ref="verifyRef"></verify>
              </el-col>
              <el-col :span="16">
                <el-button v-loading="submitLoading" type="primary" size="small" @click="submitComment">吐槽</el-button>
              </el-col>
            </el-row>
          </div>
        </div>
      </div>
    </div>
    <!-- comment list -->
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h4 v-if="commentList.length" class="card-title">Comments(Primary)</h4>
        <div v-for="item in commentList" :class="commentListBgArray[Math.floor(Math.random() * commentListBgArray.length)]">
          <div class="card-header"><i class="el-icon-map-location m-r-3"></i>{{ item.nickname || item.origin }} &nbsp;&nbsp;<small><i class="el-icon-time m-r-3"></i>{{ item.created_at }}</small></div>
          <div :class="pTextArray[Math.floor(Math.random() * pTextArray.length)]">
            <p class="card-text">{{ item.content }}</p>
            <el-button type="default" size="mini" @click="openReplyDialogVisible(item)">回复</el-button>

            <div class="comment-children">
              <ul v-if="item.replies" class="list-group list-group-flush">
                <li v-for="child in item.replies" class="list-group-item">
                  <p :class="childArray[Math.floor(Math.random() * childArray.length)]">{{ child.content }}</p>
                  <footer class="blockquote-footer text-right">
                    <small class="text-muted text-right">
                      {{ child.created_at }}，<cite title="Source Title">{{ child.nickname || child.origin }}</cite>
                    </small>
                  </footer>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <el-dialog :title="replyToWho" :visible.sync="replyDialogVisible" width="35%">
      <div class="card-body text-info" style="padding: 0.5rem;">
        <el-form ref="replyFormRef" :model="replyForm" :rules="replyRule" size="mini">
          <el-form-item prop="content" label="">
            <el-input type="textarea" v-model="replyForm.content" required rows="3"></el-input>
            <small v-show="replyContentLength" class="word-counter">{{ replyContentLength }}/225</small>
          </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
          <el-button size="mini" @click="replyDialogVisible = false">取消</el-button>
          <el-button v-loading="submitLoading" type="primary" size="mini" @click="submitReply">确定</el-button>
        </span>
      </div>
    </el-dialog>
  </div>
</template>

<script>
  const defaultCommentForm = {
    article_id: 0,
    user_id: 0,
    nickname: '',
    content: ''
  }
  export default {
    name: 'Comment',
    props: {
      articleid: [Number, String],
      required: true
    },
    computed: {
      commentContentLength() {
        return 225 - this.commentForm.content.length < 0 ? 0 : 225 - this.commentForm.content.length
      },
      replyContentLength() {
        return 225 - this.replyForm.content.length < 0 ? 0 : 225 - this.replyForm.content.length
      },
    },
    created() {
      this.commentForm = Object.assign({}, defaultCommentForm)
      this.getCommentList()
    },
    data() {
      return {
        submitLoading: false,
        replyDialogVisible: false,
        getCommentListUri: '/api/v1/open/comment/list',
        createCommentUri: '/api/v1/open/comment',
        replyCommentUri: '/api/v1/open/reply',
        commentListBgArray: [
          'card border-primary mb-3',
          'card border-secondary mb-3',
          'card border-success mb-3',
          'card border-danger mb-3',
          'card border-warning mb-3',
          'card border-info mb-3',
          'card border-light mb-3',
          'card border-dark mb-3'
        ],
        pTextArray: [
          'card-body text-a',
          'card-body text-b',
          'card-body text-c',
          'card-body text-d',
          'card-body text-e',
          'card-body text-f',
          'card-body text-g',
          'card-body text-h',
          'card-body text-i',
          'card-body text-j',
          'card-body text-k',
          'card-body text-l',
          'card-body text-m',
          'card-body text-n',
          'card-body text-o'
        ],
        childArray: [
          'text-a',
          'text-b',
          'text-c',
          'text-d',
          'text-e',
          'text-f',
          'text-g',
          'text-h',
          'text-i',
          'text-j',
          'text-k',
          'text-l',
          'text-m',
          'text-n',
          'text-o',
        ],
        commentRule: {
          content: [{ required: true, message: 'The field is required. ', trigger: 'blur' }, { max: 225, message: 'The field can\'t exceed 225 characters. ', trigger: 'change' }, { min: 1, message: 'The field can\'t be null. ', trigger: 'blur' }]
        },
        replyRule: {
          content: [{ required: true, message: 'The field is required. ', trigger: 'blur' }, { max: 225, message: 'The field can\'t exceed 225 characters. ', trigger: 'change' }]
        },
        commentForm: {},
        replyForm: {
          comment_id: 0,
          user_id: 0,
          nickname: '',
          content: ''
        },
        replyToWho: '',
        commentList: []
      }
    },
    methods: {
      refreshList() {
        this.getCommentList()
      },
      getCommentList() {
        window.axios.post(this.getCommentListUri, {all: true, article_id: this.articleid}).then(res => {
          this.commentList = res.data
        })
      },
      submitComment() {
        this.submitLoading = true
        this.commentForm.article_id = this.articleid
        this.commentForm.nickname = ''
        this.commentForm.user_agent = window.navigator.userAgent

        this.$refs.commentFormRef.validate(valid => {
          if(valid) {
            if (this.$refs.verifyRef.nowVerify === true) {
              window.axios.post(this.createCommentUri, this.commentForm).then(res => {
                if(res.status === true) {
                  this.$message.success('Comments received, pending review. ')
                  this.$refs.verifyRef.nowVerify = false
                  this.commentForm.content = ''
                  this.refreshList()
                } else {
                  this.$message.error(res.message)
                }
                return true
              }).catch(error => {
                this.$message.error(error.message)
              })
            } else {
              this.$message.error('请拖动滑块完成验证！')
            }
          }

          this.submitLoading = false
        })
      },
      openReplyDialogVisible(row) {
        this.replyForm.comment_id = row.id || 0
        this.replyToWho = '回复 ' + (row.nickname || row.origin)
        this.replyDialogVisible = true
      },
      submitReply() {
        this.submitLoading = true
        this.replyForm.user_agent = window.navigator.userAgent

        this.$refs.replyFormRef.validate(valid => {
          if(valid) {
            if(!this.replyForm.comment_id) {
              this.$message.error('Param Error')
              return true
            }
            window.axios.post(this.replyCommentUri, this.replyForm).then(res => {
              if(res.status === true) {
                this.$message.success('Reply received, pending review. ')
                this.replyForm = {
                  comment_id: 0,
                  user_id: 0,
                  nickname: '',
                  content: ''
                }
                this.refreshList()
                this.replyDialogVisible = false
              } else {
                this.$message.error(res.message)
              }
              return true
            }).catch(error => {
              this.$message.error(error.message)
            })
          }
          this.submitLoading = false
        })
      }
    }
  }
</script>

<style scoped>
  .comment-children {
    margin-top: 10px;
  }
  .comment-children ul li p {
    margin: 0;
  }
  .list-group-item {
    padding: 0.25rem 0.5rem;
  }
  .word-counter {
    position: absolute;
    right: 5px;
    bottom: 0;
  }
  .card-body {
    padding: 0.25rem 0.75rem;
  }
  .card-header {
    padding: 0.25rem 0.75rem;
  }
  .m-r-3 {
    margin-right: 3px;
    color: #653dbd;
  }
  .el-button--mini {
    padding: 5px 5px;
  }
  button:focus {
    outline: 1px dotted;
  }
  .el-dialog__body {
    padding: 10px 20px;
  }
  .text-a {
    color: #d0d896;
  }
  .text-b {
    color: #d43e4d;
  }
  .text-c {
    color: #06d96a;
  }
  .text-d {
    color: #844dff;
  }
  .text-e {
    color: #3e7bff;
  }
  .text-f {
    color: #218e22;
  }
  .text-g {
    color: #bf0a13;
  }
  .text-h {
    color: #1a1243;
  }
  .text-i {
    color: #7e55bd;
  }
  .text-j {
    color: #5b36ff;
  }
  .text-k {
    color: #accccb;
  }
  .text-l {
    color: #e6db24;
  }
  .text-m {
    color: #2492ff;
  }
  .text-n {
    color: #07ff59;
  }
  .text-o {
    color: #c5e7ff;
  }
</style>

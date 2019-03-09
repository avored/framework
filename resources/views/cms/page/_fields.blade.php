<div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"
                                        name="name"
                                        v-model="pageData.name"
                                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        id="name" />
                                        @if ($errors->has('name'))
                                        <span class='invalid-feedback'>
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text"
                                        name="slug"
                                        v-model="slug"
                                        class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}"
                                        id="slug" />
                                        @if ($errors->has('slug'))
                                        <span class='invalid-feedback'>
                                            <strong>{{ $errors->first('slug') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                @php
                                    $content = (isset($model)) ? $model->getContent() : "";
                                @endphp
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea
                                        id="content"
                                        name="content"
                                        v-model="pageData.content"
                                        class="summernote form-control"
                                    >{{ $content }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text"
                                        name="meta_title"
                                        v-model="pageData.meta_title"
                                        class="form-control {{ $errors->has('meta_title') ? ' is-invalid' : '' }}"
                                        id="meta_title" />
                                        @if ($errors->has('meta_title'))
                                        <span class='invalid-feedback'>
                                            <strong>{{ $errors->first('meta_title') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text"
                                        name="meta_description"
                                        v-model="pageData.meta_description"
                                        class="form-control {{ $errors->has('meta_description') ? ' is-invalid' : '' }}"
                                        id="meta_description" />
                                        @if ($errors->has('meta_description'))
                                        <span class='invalid-feedback'>
                                            <strong>{{ $errors->first('meta_description') }}</strong>
                                        </span>
                                    @endif
                                </div>

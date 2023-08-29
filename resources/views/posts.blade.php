@extends('layouts/master')

@section('title')
    Posts
@endsection

@section('html_css')
@endsection

@section('body')
    <div class="posts-table">
        <div>
            <table class="posts-title-table">
                <tbody class="posts-title-row">
                    <tr>
                        <td class="posts-title-col1"><h2 class="posts-title-col1">Posts</h2></td>
                        <td class="posts-title-col2"><input type="submit" name="create" value="Add" /></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="tg-wrap">
            <table class="tg">
                <thead>
                <tr>
                    <th class="tg-hd-attr tg-col-date">Date</th>
                    <th class="tg-hd-attr tg-col-title">Title</th>
                    <th class="tg-hd-attr tg-col-author">Author</th>
                    <th class="tg-hd-attr tg-col-comments">No of Comments</th>
                    <th class="tg-hd-attr tg-col-likes">No of Likes</th>
                    <th class="tg-hd-attr tg-col-edit">&nbsp;</th>
                    <th class="tg-hd-attr tg-col-del">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tg-row1-attr">2023/08/28</td>
                        <td class="tg-row1-attr"><a href="{{ url('/post_details/110') }}">post1 title1</a></td>
                        <td class="tg-row1-attr">user1</td>
                        <td class="tg-row1-attr">3</td>
                        <td class="tg-row1-attr">2</td>
                        <td class="tg-row1-attr"><button class="tg-btn-row" onclick="window.location.href='/edit_post/110'">Edit</button> </td>
                        <td class="tg-row1-attr"><button class="tg-btn-row" onclick="window.location.href='/del_post/110'">Del</button> </td>
                    </tr>
                    <tr>
                        <td class="tg-row2-attr">2023/08/28</td>
                        <td class="tg-row2-attr"><a href="{{ url('/post_details/120') }}">post2 title1</a></td>
                        <td class="tg-row2-attr">user2</td>
                        <td class="tg-row2-attr">10</td>
                        <td class="tg-row2-attr">3</td>
                        <td class="tg-row1-attr"><button class="tg-btn-row" onclick="window.location.href='/edit_post/120'">Edit</button> </td>
                        <td class="tg-row1-attr"><button class="tg-btn-row" onclick="window.location.href='/del_post/120'">Del</button> </td>
                    </tr>
                    <tr>
                        <td class="tg-row1-attr">2023/08/28</td>
                        <td class="tg-row1-attr"><a href="{{ url('/post_details/130') }}">post3 title1</a></td>
                        <td class="tg-row1-attr">user1</td>
                        <td class="tg-row1-attr">3</td>
                        <td class="tg-row1-attr">2</td>
                        <td class="tg-row1-attr"><button class="tg-btn-row" onclick="window.location.href='/edit_post/130'">Edit</button> </td>
                        <td class="tg-row1-attr"><button class="tg-btn-row" onclick="window.location.href='/del_post/130'">Del</button> </td>
                    </tr>
                    <tr>
                        <td class="tg-row2-attr">2023/08/28</td>
                        <td class="tg-row2-attr"><a href="{{ url('/post_details/140') }}">post4 title1</a></td>
                        <td class="tg-row2-attr">user3</td>
                        <td class="tg-row2-attr">10</td>
                        <td class="tg-row2-attr">3</td>
                        <td class="tg-row1-attr"><button class="tg-btn-row" onclick="window.location.href='/edit_post/140'">Edit</button> </td>
                        <td class="tg-row1-attr"><button class="tg-btn-row" onclick="window.location.href='/del_post/140'">Del</button> </td>
                    </tr>
                    <tr>
                        <td class="tg-row1-attr">2023/08/28</td>
                        <td class="tg-row1-attr"><a href="{{ url('/post_details/150') }}">post5 title1</a></td>
                        <td class="tg-row1-attr">user2</td>
                        <td class="tg-row1-attr">3</td>
                        <td class="tg-row1-attr">2</td>
                        <td class="tg-row1-attr"><button class="tg-btn-row" onclick="window.location.href='/edit_post/150'">Edit</button> </td>
                        <td class="tg-row1-attr"><button class="tg-btn-row" onclick="window.location.href='/del_post/150'">Del</button> </td>
                    </tr>
                    <tr>
                        <td class="tg-row2-attr">2023/08/28</td>
                        <td class="tg-row2-attr"><a href="{{ url('/post_details/160') }}">post6 title1</a></td>
                        <td class="tg-row2-attr">user4</td>
                        <td class="tg-row2-attr">10</td>
                        <td class="tg-row2-attr">3</td>
                        <td class="tg-row1-attr"><button class="tg-btn-row" onclick="window.location.href='/edit_post/160'">Edit</button> </td>
                        <td class="tg-row1-attr"><button class="tg-btn-row" onclick="window.location.href='/del_post/160'">Del</button> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

/**
 * Created by yangchunrun on 17/2/23.
 */
exports.install = function (Vue, options) {
    Vue.http.options.headers = {
        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
    };
    Vue.http.options.emulateJSON = true;
    Vue.prototype.callHttp = function (method, url, data, callback) {
        var params = {_token: Laravel.csrfToken};
        if (typeof data !== "undefined") {
            params = Object.assign(data, params);
        }
        if (method == 'GET') {
            var get = params;
        }

        Vue.http({url: url, method: method, body: params, params: get})
            .then(response => {
                var responseJson = response.data;
                this.func = callback;
                this.func(responseJson);

            }, response => {
                var responseJson = response.data;
                if (responseJson.error == 'Unauthenticated.') {
                    location.href = '/admin/login';
                } else {
                    var errorStr = '';
                    for (var item in responseJson) {
                        errorStr += responseJson[item][0] + ";";
                    }
                    toastr.error(errorStr, '出错啦!');
                }
            });
    }
    Vue.prototype.can = function (as) {
        var permissions = window.Permissions;
        if ($.inArray(as, permissions)>-1 || window.User.id == 1) {
            return true;
        }
        return false;
    }
};
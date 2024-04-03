import "@typespec/http";
import "@typespec/rest";
import "@typespec/versioning";
import "./models.tsp";
import "./resource.tsp";

@server("/v1", "/v1")
@service({
    title: "Laravel Backend",
})
@versioned(Versions)
namespace MediaOrgService;
enum Versions {
    v1,
}

using TypeSpec.Http;
using TypeSpec.Rest;
using TypeSpec.Versioning;

@route("/auth")
@tag("Auth")
interface Auth {
    @route("/profile")
    @get
    profile(): Models.User | Res.ErrorRes | Res.UnauthenticatedErorRes;

    @route("/login")
    @post
    login(@body body: Models.Login): {
        @body body: void;
    } | Res.ErrorRes | Res.ValidationErrorRes;

    @route("/register")
    @post
    register(@body body: Models.Login): {
        @body body: void;
    } | Res.ErrorRes | Res.ValidationErrorRes;

    @route("/logout")
    @post
    logout(): void | Res.ErrorRes | Res.UnauthenticatedErorRes;
}

@route("/todos")
@tag("Todos")
interface Todo extends global.Resource.Crud<Models.Todo> {}

@route("/users")
@tag("Manage Users")
interface User extends global.Resource.Crud<Models.User> {}

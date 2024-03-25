import "@typespec/http";
import "@typespec/rest";
import "./models.tsp";
import "./resource.tsp";

@service({
    title: "Media Org Service",
})
namespace MediaOrgService;

using TypeSpec.Http;
using TypeSpec.Rest;

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

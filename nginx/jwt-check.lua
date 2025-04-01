local jwt = require "resty.jwt"

-- Lecture du cookie manuellement
local cookies = ngx.var.http_cookie
local token = nil

if cookies then
  for cookie in string.gmatch(cookies, "([^;]+)") do
    local k, v = cookie:match("^%s*(.-)%s*=%s*(.-)%s*$")
    if k == "jwt_token" then
      token = v
      break
    end
  end
end

if not token then
  return ngx.redirect("/jwt/login.html")
end

local jwt_obj = jwt:verify("donsecure123", token)

if not jwt_obj.verified then
  return ngx.redirect("/jwt/login.html")
end

<%-- 
    Document   : login1
    Created on : May 4, 2024, 11:02:26 AM
    Author     : LENOVO
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login page</title>
    </head>
    <body>


        <%  String x = request.getParameter("email");
            String y = request.getParameter("pass");

            try {

                Class.forName("oracle.jdbc.driver.OracleDriver");

                Connection con = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:xe", "system", "sahu@66");

                PreparedStatement ps = con.prepareStatement("select * from sweet where email=?");
                ps.setString(1, x);

                ResultSet rs = ps.executeQuery();
                while (rs.next()) {
                    String a = rs.getString("email");
                    String b = rs.getString("pass");
                    if (a.equals(x) && b.equals(y)) {
        %>
        <%@include file="buy.html" %>

        <%  } else {
        %>
        <%@include file="login.html" %>

        <%
                    }
                }
            } catch (Exception e) {
                out.print(e);
            }


        %>



    </body>
</html>

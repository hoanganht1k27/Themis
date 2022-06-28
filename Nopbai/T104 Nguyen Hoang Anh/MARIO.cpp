#include<bits/stdc++.h>
using namespace std;
const long long N=5004;
long long m,n,a[N][N],t1,t2,id[N][N],limit,T,f[N][N];
long long dx[]={0,0,-1,1};
long long dy[]={1,-1,0,0};
long long last(long long x,long long y,long long time)
{
    long long mx=0;
    for(long long i=0;i<4;i++)
    {
        long long u=x+dx[i],v=y+dy[i];
        if(u>=1&&u<=m&&v>=1&&v<=n&&a[u][v]>mx) mx=a[u][v];
    }
    time=T-time;
    if(time%2==1){
        return (time-1)*(a[x][y]+mx)/2+mx;
    }
    return time*(a[x][y]+mx)/2;
}
long long cal(long long x,long long y,long long time)
{
    if(time==limit){
        return last(x,y,time);
    }
    if(f[id[x][y]][time]!=-1) return f[id[x][y]][time];
    f[id[x][y]][time]=last(x,y,time);
    for(long long i=0;i<4;i++)
    {
        long long u=x+dx[i],v=y+dy[i];
        if(u>=1&&u<=m&&v>=1&&v<=n)
        {
            f[id[x][y]][time]=max(f[id[x][y]][time],cal(u,v,time+1)+a[u][v]);
        }
    }
    return f[id[x][y]][time];
}
int main()
{
    freopen("MARIO.INP","r",stdin);
    freopen("MARIO.OUT","w",stdout);
    cin>>m>>n>>t1>>t2>>T;
    T++;
    for(long long i=1;i<=m;i++)
    {
        for(long long j=1;j<=n;j++)
        {
            cin>>a[i][j];
        }
    }
    long long dem=0;
    limit=min(m*n,T);
    for(long long i=1;i<=m;i++)
    {
        for(long long j=1;j<=n;j++)
        {
            id[i][j]=++dem;
        }
    }
    for(long long i=1;i<=m*n;i++)
    {
        for(long long j=1;j<=limit;j++) f[i][j]=-1;
    }
    cout<<cal(t1,t2,1)+a[t1][t2];
}
